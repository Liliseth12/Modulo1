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
      {{ Breadcrumbs::render('customers.edit', $customer) }}
      <h2 class="mb-3">Editar Cliente</h2>
        <form method="post" action="{{action('CustomerController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
          
          <label for="name">Nombre:</label>
          <input type="text" class="form-control" name="name" value="{{$customer->name}}"><br> 

          <label for="email">E-mail:</label>
          <input type="text" class="form-control" name="email" value="{{$customer->email}}"><br>

          <label for="is_coor">Coordinador</label>    
          <input type="checkbox" name="is_coor" value="true"><br>

          <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          
      </form>
    </div>
@endsection