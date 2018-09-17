@extends('layouts.master')
@section('title', 'Clientes')
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
        {{ Breadcrumbs::render('customers.create') }}
      <h2 class="mb-3">Agregar Cliente</h2>
      <form method="post" action="{{url('customers')}}" enctype="multipart/form-data">
        @csrf
        
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name"><br> 

            <label for="email">E-mail:</label>
            <input type="text" class="form-control" name="email"><br>

            <label for="is_coor">Coordinador</label>    
            <input type="checkbox" name="is_coor" value="true"><br>

            <button type="submit" class="btn btn-success">Submit</button>
         
      </form>
    </div>
@endsection