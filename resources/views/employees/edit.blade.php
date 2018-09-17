@extends('layouts.master')
@section('title', 'Empleados')
@section('content')
    <div class="container">
    @if($errors->any())
        <div class="alert alert-danger" >
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
    @endif

      {{ Breadcrumbs::render('edit', $employee) }}

      <h2 class="mb-3">Editar Empleado:</h2>
        <form id="form-employees-id" method="post" action="{{action('EmployeeController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group col-md-8">
              <label for="Name">Nombre:</label>
              <input type="text" class="form-control" name="firstname" id="firstname" value="{{$employee->firstname}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group col-md-8">
              <label for="LastName">Apellido:</label>
              <input type="text" class="form-control" name="lastname" id="lastname" value="{{$employee->lastname}}">
            </div>           
          </div>
          <div class="col-md-3">
            <div class="form-group col-md-12">
              <label for="Email">Correo Electrónico</label>
              <input type="text" class="form-control" name="email" id="email" value="{{$employee->email}}">
            </div>            
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group col-md-12">
              <label for="CI">Cédula de Identidad:</label>
              <input type="text" class="form-control" name="ci" id="ci" value="{{$employee->ci}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group col-md-12">
              <label for="PhoneNumber">Número de Contacto:</label>
              <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="{{$employee->phonenumber}}">
            </div>            
          </div>
            <div class="col-md-3">
              <div class="form-group col-md-4">  
                <label for="position_id">Cargo: </label> 
                <select name="position_id" id="position_id">
                    @foreach($positions as $position)
                      <option value="{{$position->id}}">
                        {{$position->position_name}}
                      </option>
                    @endforeach 
                </select>  
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group col-md-12">
              <strong>Fecha Ingreso: </strong>  
              <input class="date form-control" type="date" id="datepicker" name="entrydate"  id="entrydate" value="{{$employee->entrydate}}">   
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group col-md-12">
              <strong>Fecha Egreso: </strong>  
              <input class="date form-control" type="date" name="outdate" id="outdate" value="{{$employee->outdate}}">   
            </div>        
          </div>
          <div class="col-md-3">  
            <div class="form-group col-md-4">
              <label for="department_id">Departamento: </label> 
              <select name="department_id" id="department_id">
                @foreach($departments as $department)
                  <option value="{{$department->id}}">
                    {{$department->department_name}}
                  </option>
                @endforeach 
              </select>    
            </div>
          </div>        
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="button" class="btn btn-success" style="margin-left:38px" data-toggle="modal" data-target="#exampleModalCenter">
              Aplicar
            </button>
          </div>
        </div>
      </form>
      {{-- MODAL PART --}}
      @extends('layouts.partials.modal')
      @section('form')
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{ method_field('patch')}}
        <button type="submit" form="form-employees-id" class="btn btn-success">Save changes</button>
      @endsection
    </div>
@endsection