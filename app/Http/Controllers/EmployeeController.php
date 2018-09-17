<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\EmployeeRequest;
use \App\Http\Requests\EmployeeEditRequest;
use Illuminate\Support\Facades\DB;
use Session;
use \App\Employee;
use \App\Salary;
use \App\Position;
use \App\Country;
use \App\Department;

class EmployeeController extends Controller
{   
    //--------------------------------
    //For Ajax view
    // public function index(){
    //     return view('layouts.master');
    // }
    //The next function will be public funcion employees() 
    //for the Ajax example
    //return response()->json($employees);
    //--------------------------------
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //By default show all the users with no 'outdate'
        //Also pick all the employees working until this day. 
        $date=date_create();
        $format = date_format($date,"Y-m-d");
        $first = DB::table('employees')
                    ->whereNull('outdate');

        $employees = DB::table('employees')
                    ->where('outdate', '>=', $format)
                    ->union($first)
                    ->get();

        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $positions   = Position::where('deleted_at', '=', NULL)->get();
        $countries   = Country::where('deleted_at', '=', NULL)->get();
        $departments = Department::where('deleted_at', '=', NULL)->get();
        return view('employees.create')->with('positions', $positions)
                                       ->with('countries', $countries)
                                       ->with('departments', $departments);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee= new Employee;
        $employee->firstname=$request->post('firstname');
        $employee->lastname=$request->post('lastname');
        $employee->email=$request->post('email');
        $employee->ci=$request->post('ci');
        $employee->country_id=$request->post('country_id');
        $employee->department_id=$request->post('department_id');
        $employee->phonenumber=$request->post('phonenumber');
        $date=date_create($request->post('date'));
        $format = date_format($date,"Y-m-d");
        $employee->entrydate=$format;
        $employee->save();

        $employee = \App\Employee::find($employee->id);

        //It stores the data in the pivot table (employee_position)
        $position = Position::find($request->post('position_id'));
        $position->employees()->attach($employee, ['date' => $format]);


        $salary= new \App\Salary;
        $salary->amount=$request->post('amount');
        $salary->save();

        $employee->salaries()->attach($salary, ['date' => $format]);        

        return redirect('employees')->with('success', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employee = Employee::find($id);
        //$country = $employee->country->name;
        $actualposition = $employee->positions->pluck('position_name')->last();
        $actualsalary = $employee->salaries->pluck('amount')->last();

        // foreach($employee->salaries as $salary)
        // {
        //     echo $salary->amount;
        //     echo $salary->pivot->date;
        // }

        return view('employees.show', compact('employee', $employee))
                    ->with('actualposition', $actualposition)                        
                    ->with('actualsalary', $actualsalary);
    
        // $employees->salaries()->employees;
        // $salaries = $employee->salaries;
        // $positions = $employee->positions;
        // return view('employees.show')->with('employee', $employees)
        //                              ->with('salary', $salaries)
        //                              ->with('positions', $positions);
        //------------------------||-------------------|||-------------------
        //   $salaries = Employee::find($id)->salaries()->first();
        //   $employees = Employee::find($id);
        //   $positions = Employee::find($id)->positions()->first(); 

        //   return view('employees.show')->with('employee', $employees)
        //                                ->with('salary', $salaries)
        //                                ->with('position', $positions);
        //-----------------------||---------------|||-------------------------
        //-------HISTORIAL SALARIO & POSITIONS---------------
        // $employee = Employee::find($id);
        // foreach ($employee->salaries as $salary){
        //     echo $salary->amount;
        //     echo " ";
        //     echo $salary->pivot->date;
        //     echo ' ';
        // }
        // foreach ($employee->positions as $position){
        //     echo $position->position_name;
        //     echo " ";
        //     echo $position->pivot->date;
        //     echo " ";
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee=\App\Employee::find($id);
        //Let's create the query to find the actual employee position

        //-Right Here
        $actualdepartment= $employee->department->department_name;
        //dd($actualdepartment);
        $positions = \App\Position::where('deleted_at', '=', NULL)->get();
        $departments =\App\Department::where('deleted_at', '=', NULL)->get();
        return view('employees.edit',compact('employee','id'))
                    ->with('positions', $positions)
                    ->with('departments', $departments)
                    ->with('actualdepartment', $actualdepartment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeEditRequest $request, $id)
    {
        //
        // dd($request);
        Session::flash('success', 'User successfully updated');
        $employee=\App\Employee::find($id);
        $employee->firstname=$request->post('firstname');
        $employee->lastname=$request->post('lastname');
        $employee->email=$request->post('email');
        $employee->ci=$request->post('ci');
        $employee->phonenumber=$request->post('phonenumber');
        $employee->department_id=$request->post('department_id');
        $entrydate=date_create($request->post('entrydate'));
        $format = date_format($entrydate,"Y-m-d");
        $employee->entrydate=$format;
        $outdate = $request->post('outdate');
        if(isset($outdate)){
            $outdate=date_create($outdate);
            $format = date_format($outdate,"Y-m-d");
            $employee->outdate=$format;
            $employee->active=0;
        }   
        $employee->save();

        //It store the data in the pivot table (employee_position)
        $position = Position::find($request->post('position_id'));
        $position->employees()->attach($employee, ['date' => $format]);
        //Take all the employee attributes
        $employee=\App\Employee::find($id);
        $actualposition = $employee->positions->pluck('position_name')->last();
        $actualsalary = $employee->salaries->pluck('amount')->last();

        return view('employees.show', compact('employee', $employee))
                    ->with('actualposition', $actualposition)                        
                    ->with('actualsalary', $actualsalary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
