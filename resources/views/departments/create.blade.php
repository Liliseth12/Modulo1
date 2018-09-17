@extends('layouts.master')
@section('title', 'Departamentos')
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
    	{{ Breadcrumbs::render('departments.create') }}
    <h2 class="mb-3">Agregar Departamento:</h2>
    
      <form method="post" action="{{url('departments')}}" enctype="multipart/form-data">
        @csrf
        
            <label for="Name">Nombre:</label>
            <input type="text" class="form-control" name="department_name"><br> 
            <button type="submit" class="btn btn-success">Submit</button>

      </form>
    </div>
@endsection