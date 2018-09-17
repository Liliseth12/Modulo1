@extends('layouts.master')
@section('title', 'Marcas')
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
      {{ Breadcrumbs::render('brands.create') }}
      <h2>Agregar Marca</h2><br/>
      <form method="post" action="{{url('brands')}}" enctype="multipart/form-data">
        @csrf
        
            <label for="Name">Nombre:</label>
            <input type="text" class="form-control" name="name">
            <br>
            <label for="Country">País:</label>
            <select name="country_id">
              @foreach($countries as $country)
              <option value="{{$country->id}}">
                {{$country->name}}
              </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-success">Submit</button>
         
      </form>
    </div>
@endsection