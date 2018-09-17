<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use \App\Salary;
use \App\Employee;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date=date_create($request->post('from'));
        $format = date_format($date,"Y-m-d");
        $range1 = $format;
        $date=date_create($request->post('to'));
        $format = date_format($date,"Y-m-d");
        $range2 = $format;

        $employee = Employee::find($request->post('id'));
        $filters = $employee;
        $filters = \DB::table('employees')
        ->join('employee_salary', 'employee_id', '=', 'employees.id')
        ->where('employees.id', $request->post('id'))
        ->whereBetween('date', [$range1, $range2])
        ->get();

        //Check out if there's filter result, otherwise assign -1
        $var = $filters->count();
        if(empty($var)){
            $var = -1;
        }

         $id_amount = $filters->pluck('salary_id')->all();

         $filters = $filters->pluck('date')->all();

         $amounts = $employee->salaries()
               ->whereIn('salary_id', $id_amount)
               ->pluck('amount');

        //return dd($filters, $amounts);
        return view('employees.salaryrecord', compact('employee', $employee))
                    ->with('filters', $filters)
                    ->with('amounts', $amounts)
                    ->with('var', $var);
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
        return view('employees.salaryrecord', compact('employee', $employee));
    
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
