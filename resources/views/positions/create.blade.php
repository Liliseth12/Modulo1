@extends('layouts.master')
@section('title', 'Cargos')
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
    	{{ Breadcrumbs::render('positions.create') }}

      <h2 class="mb-3">Agregar Cargo:</h2>
      <form method="post" action="{{url('positions')}}" enctype="multipart/form-data">
        @csrf
        
            <label for="PositionName">Nombre:</label>
            <input type="text" class="form-control" name="position_name"><br> 
            <button type="submit" class="btn btn-success">Submit</button>

      </form>
    </div>
@endsection