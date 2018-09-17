@extends('layouts.master')
@section('title', 'Cargos')
@section('content')
	<div class="container">
@include('layouts.partials.flashmessage')
  
  {{ Breadcrumbs::render('positions.index') }}

  @if(auth()->user()->isAdmin == 1)
      <h2 class="mb-3">Lista Cargos:</h2>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>   
      @foreach($positions as $position)
      @if (empty($position->deleted_at))
      <tr>
        <td>{{$position['position_name']}}</td>
        <td>
          <a href="{{action('PositionController@edit', $position['id'])}}" class="btn btn-warning">
            Edit
          </a>
        </td>
        <td>
          <form id="form-positions-id" action="{{action('PositionController@destroy', $position['id'])}}" method="post">
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
          <td>{{$position['position_name']}}</td>
          <td></td>
          <td></td>
        </tr>
      @endif
      @endforeach
    </tbody>
  </table>
        <div class="col-md-4">
          <a href="{{action('PositionController@create')}}" class="btn btn-warning">Add</a>
        </div>
  </div>
  @endif
@endsection