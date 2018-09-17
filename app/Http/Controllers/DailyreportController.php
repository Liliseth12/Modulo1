<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Session;
use Excel;
use File;
use \App\Employee;

class DailyreportController extends Controller
{
    //For the Ajax example
    //return response()->json($employees);
    
    public function index()
    {
        $employees = Employee::where('active', '=', 1)->get();
        $var  = 0;
        return view('dailyreports.index')->with('employees', $employees)
                                         ->with('var', $var);
    }

     public function showimport()
    {
        return view('dailyreports.addfile');
    }


    public function show(Request $request){
        //dd($request);

        $particular = Employee::find($request->post('id'));
        //Show an error message when the employee selected is empty
        if($particular == NULL){
            Session::flash('error', 'Please check the fields below');
            return back();
        }
        //dd($particular);
        $employees = Employee::where('active', '=', 1)->get();
        $dailyreports = DB::table('dailyreports')->where('employee_id', $request->post('id'))
                                                 ->select('date', 'arrival_time', 'departure_time')
                                                 ->latest('date')                                                 
                                                 ->take(15)
                                                 ->get();
        //dd(gettype($particular));
        //Check out if there's filter results
        $var = $dailyreports->count();
        //dd($var);
        //Get the dates
        $range1 = $request->post('from');
        $range2 = $request->post('to');                                         
        //If there's a filter query save the dates
        if(isset($range1) && isset($range2)){
            $date=date_create($range1);
            $format = date_format($date,"Y-m-d");
            $range1 = $format;
            $date=date_create($range2);
            $format = date_format($date,"Y-m-d");
            $range2 = $format;

        //Let's create the filter query
            $dailyreports = \DB::table('dailyreports')
            ->where('employee_id', '=', $request->post('id'))
            ->whereBetween('date', [$range1, $range2])
            ->get();

            $var = $dailyreports->count();
        }
        //Check out if there's filter results, otherwise assign -1
            if(empty($var)){
                $var = -1;
            }

        return view('dailyreports.index', compact('employees', $employees))
                    ->with('dailyreports', $dailyreports)
                    ->with('particular', $particular)
                    ->with('var', $var);
    }
 
    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            //Save the deafult Excel header
            $excelHeader = array('ac_no.', 'nombre', 'fecha', 'marc_ent', 'marc_sal', 'tardanza', 'saliotempr', 'horaextra');
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            //Read the Excel file
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                //dd($data);
            //Get the Excel header of the request
                $headerRow = $data->first()->keys()->toArray();
            //Validate the Excel file with the standard parameters
                if(count($headerRow) != 8){
                    Session::flash('error', '1The Excel file has incorrect format. Please check it out');
                    return back();
                }elseif (count($headerRow) == 8){
                    $result_array = array_intersect_assoc($headerRow, $excelHeader);
                    if($result_array !== $excelHeader){
                        Session::flash('error', '2The Excel file has incorrect format. Please check it out');
                        return back();
                    }else{
                        if(!empty($data) && $data->count()){
                            foreach ($data as $key => $value) {
                                //Verify that the Excel file has no empty fields      
                                //dd(strcspn($value->fecha,"/"));
                                //dd($data);                                
                                $verify = substr_count($value->fecha,"/");
                                //dd($verify);
                                //dd($value->fecha);              
                                    if(empty($value->fecha)){
                                        //dd($verify);
                                         Session::flash('error', '3The Excel file has incorrect fields. Please check it out!');
                                         return back();
                                    }
                                    if($verify<>2){
                                        Session::flash('error', '4The Excel file has incorrect fields. Please check it out!');
                                         return back();
                                    }   
                                //It transforms all the dates into Y-m-d (The actual format)
                                $ymd= DateTime::createFromFormat('d/m/Y', $value->fecha)->format('Y-m-d');
                                //Let's see if there's duplicated data
                                $duplicated = DB::table('dailyreports')->where('date', $ymd)
                                                                       ->first();
                                if(isset($duplicated)){
                                    Session::flash('error', '5The excel file is already imported!');
                                    return back();
                                    //dd($ymd, $duplicated);    
                                }
                                //dd(gettype($value->marc_ent));
                                //It simplifies the redundant data
                                $employee = DB::table('employees')
                                                ->where('ci', $value->{'ac_no.'})
                                                ->select('id')
                                                ->pluck('id');
                                                
                                $insert[] = [
                                'employee_id' => $employee[0],
                                'date' => $ymd,
                                'arrival_time' => $value->marc_ent,
                                'departure_time' => $value->marc_sal,
                                'delay' => $value->tardanza,
                                'early' => $value->salioTempr,
                                'extrahour' => $value->horaextra,
                                ];                
                            }   
                        }
                        //Notifications:
                        //Date- From - To - Subject - Active
                        //Let's create the date --It has to be changed--
                        $format = date_create();
                        $notification_date = date_format($format,"Y-m-d");
                        //Let's find the admin email address of the actual user
                        $notification_from = Auth::user()->email;
                        //Let's define the default subject
                        $notification_subject = 'Esto es una notificacion';
                        //By deafult the active value is 1
                        $notification_active = 1;
                        //Let's find the coordinator's emails
                        $coordinators = DB::table('users')->where('isAdmin', '=', NULL)
                                                          ->select('email')->get();
                        
                        // if(Auth::user()->isAdmin == NULL){
                        //     $notification_to = Auth::user()->email;
                        // }
                        dd($notification_from, $notification_date, $coordinators);
                    }   
                //dd($headerRow, $data);
                    if(!empty($insert)){
 
                        $insertData = DB::table('dailyreports')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
                 return back();
                }else {
                    Session::flash('error', 'File is a '.$extension.' file. Please upload a valid xls/csv file');
                    return back();
                }
        }
    } 

}
