<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Employee;

class InactiveController extends Controller
{
    //
    public function index()
    {
        //$employees = Employee::where('active', '=', 0)->get();
    	$date=date_create();
        $format = date_format($date,"Y-m-d");

        $employees = DB::table('employees')
                    ->where('outdate', '<', $format)
                    ->get();

        return view('employees.index')->with('employees', $employees);
    }
}
