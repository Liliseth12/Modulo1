@extends('layouts.master')
@section('title', 'Marcas')
@section('content')
<div class="container">
@include('layouts.partials.flashmessage')
  {{ Breadcrumbs::render('brands.index') }}
    <br />
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>País</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($brands as $brand)
      <tr>
        <td>{{$brand->name}}</td>
        <td>{{$brand->country->name}}</td>
        <td><a href="{{action('BrandController@edit', $brand['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form id="form-brands-id" action="{{action('BrandController@destroy', $brand['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
    <div class="col-md-4">
      <a href="{{action('BrandController@create')}}" class="btn btn-warning">Add</a>
    </div>
  </div>
 </div>
@endsection