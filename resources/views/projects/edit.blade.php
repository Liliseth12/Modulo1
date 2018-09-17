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
@include('layouts.partials.flashmessage')

    {{ Breadcrumbs::render('projects.edit', $project) }}

      <h2>Editar Proyecto</h2><br  />
        <form method="post" action="{{action('ProjectController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
          
          <label for="Title">Título:</label>
          <input type="text" class="form-control" name="title" value="{{$project->title}}"><br> 

          <label for="Duration">Duración:</label>
          <input type="text" class="form-control" name="duration" value="{{$project->duration}}"><br>

          <label for="Start_date">Fecha de Inicio:</label>    
          <input type="date" name="start_date" id="StartDate" value="{{$project->start_date}}"><br>

          <label for="Brand">Marca:</label>  
          <select name="{{ 'brand_id' }}">
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
          </select>  

          <label for="Customer">Cliente:</label>  
          <select name="{{ 'customer_id' }}">
            @foreach($customers as $customer)
            <option value="{{ $customer->id }}">
              {{ $customer->name }}
            </option>
            @endforeach
          </select> 
        
          <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          
      </form>
    </div>
@endsection