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
      {{ Breadcrumbs::render('brands.edit', $brand) }}
      <h2>Editar Marca</h2><br  />
        <form method="post" action="{{action('BrandController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        
          <label for="name">Nombre:</label>
          <input type="text" class="form-control" name="name" value="{{$brand->name}}">
          <br>
          <label for="Country">País:</label>
            <select name="country_id">
              @foreach($countries as $country)
              <option value="{{$country->id}}">
                {{$country->name}}
              </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          
      </form>
    </div>
@endsection