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

    {{ Breadcrumbs::render('employees.create') }}

      <h2 class="mb-3">Agregar Empleado:</h2>

      <form method="post" action="{{url('employees')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group col-md-8">
              <label for="Name">Nombre:</label>
              <input type="text" class="form-control" name="firstname" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group col-md-8">
              <label for="LastName">Apellido:</label>
              <input type="text" class="form-control" name="lastname" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group col-md-8">
              <label for="Email">Correo Electrónico:</label>
              <input type="email" class="form-control" name="email">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group col-md-6">
              <label for="CI">Cédula de Identidad:</label>
              <input type="text" class="form-control" name="ci" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group col-md-8">
              <label for="PhoneNumber">Número de Contacto:</label>
              <input type="text" class="form-control" name="phonenumber">
            </div>  
          </div>
          <div class="col-md-6">
            <div class="form-group col-md-6">
              <label for="EntryDate">Fecha Ingreso: </label>  
              <input class="date form-control" type="date" id="DatePicker" name="date">   
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">  
          <div class="form-group col-md-8">
            <label for="Salary">Salario Inicial: </label>  
            <input class="date form-control" type="text" name="amount" required>   
         </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">  
            <div class="form-group col-md-4">
              <label for="country_id">País: </label> 
              <select name="country_id">
                  @foreach($countries as $country)
                    <option value="{{$country->id}}">
                      {{$country->name}}
                    </option>
                  @endforeach 
              </select>
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group col-md-4">
              <label for="department_id">Departamento: </label> 
              <select name="department_id">
                @foreach($departments as $department)
                  <option value="{{$department->id}}">
                    {{$department->department_name}}
                  </option>
                @endforeach 
              </select>    
            </div>
          </div>
          <div class="col-md-4">  
            <div class="form-group col-md-4">
              <label for="position_id">Cargo: </label> 
              <select name="position_id">
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
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">
      document.getElementById("DatePicker").valueAsDate = new Date();
    </script>
@endsection
