<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PositionRequest;
use DB;
use Session;
use \App\Salary;
use \App\Employee;
use \App\Position;

class PositionController extends Controller
{
    //For the Ajax Example
    //return response()->json($positions);
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $positions=\App\Position::all();
        return view('positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        //
        $position = Position::firstOrCreate(['position_name' => $request->post('position_name')]);
        // $position->position_name=$request->post('position_name');
        // $position->save();

        return redirect('positions');

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
        return view('employees.positionsrecord', compact('employee', $employee));
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
        $position = \App\Position::find($id);
        return view('positions.edit', compact('position', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        //
        Session::flash('success', 'Information has been updated');
        $position = \App\Position::find($id);
        // $new = DB::table('positions')->where('position_name', '=', $position->position_name);
        // if(isset($new)){
        //     Session::flash('error', 'Este nombre ya se encuentra registrado');
        //     return back();
        // }else{
            $position->position_name=$request->post('position_name');
            $position->save();

            return redirect('positions');

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
        Session::flash('success', 'Information has been deleted');
        $position = \App\Position::find($id);
        $position->delete();

        return redirect('positions');
    }
}
