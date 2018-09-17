@extends('layouts.master')
@section('title', 'Paises')
@section('content')
<div class="container">
@include('layouts.partials.flashmessage')

  {{ Breadcrumbs::render('countries.index') }}

  @if(auth()->user()->isAdmin == 1)
      <h2 class="mb-3">Lista Paises:</h2>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>      
    @foreach($countries as $country)
      @if (empty($country->deleted_at))
        <tr>
          <td>{{$country['name']}}</td>
          <td><a href="{{action('CountryController@edit', $country['id'])}}" class="btn btn-warning">Edit</a></td>
          <td>
            <form id="form-countries-id" action="{{action('CountryController@destroy', $country['id'])}}" method="post">
              @csrf
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger" type="submit">
                Delete
              </button>
            </form>
          </td>
        </tr>
      @else
        <tr>
            <td>{{$country['name']}}</td>
            <td></td>
            <td></td>
          </tr>
      @endif
    @endforeach
    </tbody>
  </table>
    <div class="col-md-4">
      <a href="{{action('CountryController@create')}}" class="btn btn-warning">Add</a>
    </div>
  @endif
</div>
@endsection