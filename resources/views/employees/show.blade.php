@extends('layouts.master')
@section('title', 'Empleado')
@section('content')
  <div class="container">
@include('layouts.partials.flashmessage')

  {{ Breadcrumbs::render('employee', $employee) }}
    <tbody>
      <h2 class="mb-3">
          {{$employee->firstname}} 
          {{$employee->lastname}}
      </h2>
      <div>
        <ul>
          <li>C.I. : {{$employee->ci}}</li><br>
          <li>País: {{$employee->country->name}}</li><br>
          <li>Correo : {{$employee->email}}</li><br>
          <li>Número de Contacto : {{$employee->phonenumber}}</li><br>
          <li>Fecha de Ingreso : {{$employee->entrydate}}</li><br>
          <li>Departamento: {{$employee->department->department_name}}</li><br>

          <li>Cargo Actual : {{$actualposition}}
          <a href="{{action('PositionController@show', $employee['id'])}}" class="btn btn-success">
            Historial Cargos
          </a>
          </li><br>
          
          <li>Salario Actual : {{$actualsalary}} Bs.           
            <a href="{{action('SalaryController@show', $employee['id'])}}" class="btn btn-success">
              Historial Salarios
            </a>
          </li>
        </ul>
      </div>
  </div>
@endsection
