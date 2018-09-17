@extends('layouts.master')
@section('title', 'Empleado')
@section('content')
  <div class="container">
{{ Breadcrumbs::render('positions', $employee) }}
    <h2 class="mb-3">
        Historial de Cargos de:   
        {{$employee->firstname}} 
        {{$employee->lastname}}
    </h2>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>A la Fecha</th>
          <th>Cargo</th>
        </tr>
      </thead> 
      <tbody>
      @foreach($employee->positions as $position)
        <tr>
          <th>{{$position->pivot->date}}</th>
          <th>{{$position->position_name}}</th>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection
