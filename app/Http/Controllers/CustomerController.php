<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerEditRequest;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers=\App\Customer::all();
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        $customer = new \App\Customer;
        $customer->name=$request->post('name');
        $customer->email=$request->post('email');
        $customer->is_coor=$request->post('is_coor');
        $customer->save();

        return redirect('customers');
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
        $customer = \App\Customer::find($id);
        return view('customers.edit', compact('customer', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerEditRequest $request, $id)
    {
        //
        Session::flash('success', 'Information has been updated');
        $customer = \App\Customer::find($id);
        $customer->name=$request->post('name');
        $customer->email=$request->post('email');
        $customer->save();

        return redirect('customers');
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
        $customer = \App\Customer::find($id);
        $customer->delete();

        return redirect('customers');
    }
}
