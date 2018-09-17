<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use \App\Country;
use Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands=\App\Brand::all();
        $countries = \App\Country::all();
        return view('brands.index',compact('brands'))
                    ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = \App\Country::where('deleted_at', '=', NULL)->get();
        return view('brands.create')->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        //
        $brand= new \App\Brand;
        $brand->name= $request->get('name');
        $brand->country_id= $request->get('country_id');
        $brand->save();

        return redirect('brands');
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
        $brand=\App\Brand::find($id);
        $countries=Country::where('deleted_at', '=', NULL)->get();
        return view('brands.edit',compact('brand','id'))
                ->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        //
        Session::flash('success', 'Information has been updated');
        $brand = \App\Brand::find($id);
        $brand->name = $request->get('name');
        $brand->country_id= $request->get('country_id');
        $brand->save();

        return redirect('brands');
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
        $brand = \App\Brand::find($id);
        $brand->delete();

        return redirect('brands');
    }
}
