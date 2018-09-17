@extends('layouts.master')
@section('title', 'Proyectos')
@section('content')
	<div class="container">
@include('layouts.partials.flashmessage')

  {{ Breadcrumbs::render('projects.index') }}
    <br />
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Marca</th>
        <th>Titulo</th>
        <th>Departamento</th>
        <th>Duración (días)</th>
        <th>Fecha de Inicio</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($projects as $project)
      <tr>
        @php
          //dd($project);
        @endphp
        <td>{{$project->brand->name}}</td>
        <td>{{$project->title}}</td>
        <td>{{$project->department->department_name}}</td>
        <td>{{$project->duration}}</td>
        <td>{{$project->start_date}}</td>
	       
        <td><a href="{{action('ProjectController@edit', $project['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('ProjectController@destroy', $project['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="col-md-4">
    <a href="{{action('ProjectController@create')}}" class="btn btn-warning">Add</a>
  </div>
  </div>
@endsection