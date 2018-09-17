@extends('layouts.master')
@section('title', 'Paises')
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
@include('layouts.partials.flashmessage')

    {{ Breadcrumbs::render('projects.create') }}

      <h2>Agregar Proyecto</h2><br/>
      <form method="post" action="{{url('projects')}}" enctype="multipart/form-data">
        @csrf
        
        <label for="Title">Título:</label>
        <input type="text" class="form-control" name="title"><br> 

        <label for="Duration">Duración:</label>
        <input type="text" class="form-control" name="duration" placeholder="Número en días"><br> 

        <label for="Start_date">Fecha de Inicio:</label>
        <input type="date" class="form-control" id="StartDate" name="start_date"><br> 
        
        <label for="Brand">Marca:</label>  
        <select name="{{ 'brand_id' }}">
          @foreach($brands as $brand)
          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
          @endforeach
        </select>  

        <label for="Customer">Cliente:</label>  
        <select name="{{ 'customer_id' }}">
          @foreach($customers as $customer)
          <option value="{{ $customer->id }}">
            {{ $customer->name }}
          </option>
          @endforeach
        </select> 

        @if(auth()->user()->isAdmin == 1)
        <label for="Department">Departamentos:</label>  
        <select name="{{ 'department_id' }}">
          @foreach($departments as $department)
          <option value="{{ $department->id }}">
            {{ $department->department_name }}
          </option>
          @endforeach
        </select> 
        @endif
        <button type="submit" class="btn btn-success">Submit</button>      
      </form>
    </div>
    <script type="text/javascript">
      document.getElementById("StartDate").valueAsDate = new Date();
    </script>
@endsection