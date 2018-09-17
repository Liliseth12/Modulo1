<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;
use Session;
use Illuminate\Support\Facades\DB;
use \App\Employee;
use \App\Department;
use \App\Brand;
use \App\Customer;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        $projects = \App\Project::all();
        $departments = \App\Department::all();
        $brands = \App\Brand::withTrashed()->get();
        //dd($brands);
            return view('projects.index', compact('projects'))
                    ->with('brands', $brands)
                   ->with('departments', $departments);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = \App\Brand::all();
        $customers = \App\Customer::all();
        //If the user is Admin, then show the department list
        if(auth()->user()->isAdmin){
            $departments = \App\Department::where('deleted_at', '=', NULL)->get();
            return view('projects.create')->with('brands', $brands)
                                          ->with('customers', $customers)
                                          ->with('departments', $departments);
        }
        return view('projects.create')->with('brands', $brands)
                                      ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        //
        $project = new \App\Project;
        $project->title = $request->post('title');
        $project->duration = $request->post('duration');
        $date=date_create($request->post('start_date'));
        $format = date_format($date,"Y-m-d");
        $project->start_date=$format;
        $project->brand_id= $request->post('brand_id');
        $project->customer_id= $request->post('customer_id');

        //---Query to determinate the user's department
            //We're considering that every user has to be an employee first (obligatorily)
            //Also, the user has the same email address as the employee involved
        if(auth()->user()->isAdmin == 1){
            $project->department_id = $request->post('department_id');
        }else{
            $user = Auth::user()->email;
            $employee = DB::table('employees')->where('email', '=', $user)                              ->select('department_id')
                                              ->first();    
            if(empty($employee)){
                Session::flash('error', 'Incompatibilidad entre usuario y empleado. Revise registros');
                return back();
            }
            $project->department_id = $employee->department_id;                 
        }

        $project->save();

        return redirect('projects');    
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
        //dd($id);
        $project = \App\Project::find($id);
        $brand_id = $project->brand_id;
        $customer_id = $project->customer_id;
        $brands = \App\Brand::all();
        $customers = \App\Customer::all();
        return view('projects.edit', compact('project', 'id'))
                    ->with('brand_id', $brand_id)
                    ->with('customer_id', $customer_id)
                    ->with('brands', $brands)
                    ->with('customers', $customers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        //
        Session::flash('success', 'Information has been updated');
        $project = \App\Project::find($id);
        $project->title=$request->post('title');
        $project->duration=$request->post('duration');
        $date=date_create($request->post('start_date'));
        $format = date_format($date,"Y-m-d");
        $project->start_date=$format;
        $project->brand_id= $request->post('brand_id');
        $project->customer_id= $request->post('customer_id');
        
        //---Query to determinate the user's department
            //We're considering that every user has to be an employee first (obligatorily)
            //Also, the user has the same email address as the employee involved
        $user = Auth::user()->email;
        $employee = DB::table('employees')->where('email', '=', $user)                                
                                          ->select('department_id')
                                          ->first();
        
        if(empty($employee)){
            Session::flash('error', 'Incompatibilidad entre usuario y empleado. Revise registros');
            return back();
        }
        $project->department_id = $employee->department_id;  

        $project->save();

        return redirect('projects');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //dd($id);
        Session::flash('success', 'Information has been deleted');
        $project = \App\Project::find($id);
        $project->delete();

        return redirect('projects');
    }
}
