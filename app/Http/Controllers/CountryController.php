<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use Session;
use \App\Country;

class CountryController extends Controller
{
    //For the Ajax Example
    //return response()->json($countries);
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $countries = \App\Country::all();
        return view('countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        //
        $country = Country::firstOrCreate(['name' => $request->post('name')]);

        // $country= new \App\Country;
        // $country->name=$request->get('name');
        //$country->save();

        return redirect('countries');
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
        $country= \App\Country::find($id);
        return view('countries.edit',compact('country', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        //
        Session::flash('success', 'Information has been updated');
        $country= \App\Country::find($id);
        $country->name=$request->get('name');
        $country->save();

        return redirect('countries');
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
        $country = \App\Country::find($id);
        $country->delete();

        return redirect('countries');
    }
}
