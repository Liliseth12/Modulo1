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
      {{ Breadcrumbs::render('countries.edit', $country) }}
      <h2 class="mb-3">Lista Paises:</h2>
        <form method="post" action="{{action('CountryController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        
          <label for="name">Nombre:</label>
          <input type="text" class="form-control" name="name" value="{{$country->name}}">
          <br>
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          
      </form>
    </div>
@endsection