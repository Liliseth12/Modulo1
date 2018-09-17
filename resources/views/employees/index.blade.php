@extends('layouts.master')
@section('title', 'Empleados')
@section('content')
<div class="container">
@include('layouts.partials.flashmessage')

  {{ Breadcrumbs::render('employees') }}

    <h2 class="mb-3">Lista Empleados:</h2>
@include('layouts.partials.tab')
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>C.I.</th>
          <th colspan="2">Action</th>
        </tr>
      </thead> 
      <tbody>
        @foreach($employees as $employee)
        <tr>
          <td>{{$employee->firstname}}</td>
          <td>{{$employee->lastname}}</td>
          <td>{{$employee->ci}}</td> 
          <td>
            <a href="{{action('EmployeeController@show', $employee->id)}}" class="btn btn-success">Ver</a>
          </td>
          <td>
            @if(auth()->user()->isAdmin == 1 && $employee->active == 1)
            <a href="{{action('EmployeeController@edit', $employee->id)}}" class="btn btn-warning">Editar</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      @if(auth()->user()->isAdmin == 1)
        <div class="col-md-4">
          <a href="{{action('EmployeeController@create')}}" class="btn btn-warning">Add</a>
        </div>
      @endif
</div>
@endsection
