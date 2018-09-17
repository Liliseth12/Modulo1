@extends('layouts.master')
@section('title', 'Departamentos')
@section('content')
	<div class="container">
@include('layouts.partials.flashmessage')

  {{ Breadcrumbs::render('departments.index') }}

  @if(auth()->user()->isAdmin == 1)
    <h2 class="mb-3">Lista Departamentos:</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>      
      @foreach($departments as $department)
      @if (empty($department->deleted_at))
      <tr>
        <td>{{$department['department_name']}}</td>      
        <td><a href="{{action('DepartmentController@edit', $department['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('DepartmentController@destroy', $department['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @else
      <tr>
        <td>{{$department['department_name']}}</td>
        <td></td>
        <td></td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
    <div class="col-md-4">
      <a href="{{action('DepartmentController@create')}}" class="btn btn-warning">Add</a>
    </div>
  </div>
@endif
@endsection