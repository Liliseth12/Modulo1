@extends('layouts.master')
@section('title', 'Cargos')
@section('content')
<div class="container">
@include('layouts.partials.flashmessage')
	@if($errors->any())
      <div class="alert alert-danger" >
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
{{ Breadcrumbs::render('positions.edit', $position) }}
      <h2 class="mb-3">Editar Cargos:</h2>
        <form method="post" action="{{action('PositionController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
          
          <label for="position_name">Nombre:</label>
          <input type="text" class="form-control" name="position_name" value="{{$position->position_name}}"><br>

          <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          
      </form>
    </div>
</div>
@endsection