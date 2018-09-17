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
      {{ Breadcrumbs::render('departments.edit', $department) }}
    <h2 class="mb-3">Editar Departamento:</h2>
        <form method="post" action="{{action('DepartmentController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
          
          <label for="department_name">Nombre:</label>
          <input type="text" class="form-control" name="department_name" value="{{$department->department_name}}"><br>

          <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          
      </form>
    </div>
@endsection