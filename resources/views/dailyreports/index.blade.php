@extends('layouts.master')
@section('title', 'Reportes')
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

  {{ Breadcrumbs::render('dailyreports.index') }}

      <h2 class="mb-3">Reportes Diarios
      @if(isset($dailyreports))
        : {{$particular->firstname}}  {{$particular->lastname}}
      @endif  
      </h2>
      <form method="post" action="{{action('DailyreportController@show')}}" enctype="multipart/form-data">
        @csrf       
        <div class="row">
            <div class="col-mx-2-md-2">
	            <label for="id">Empleado: </label> 
	              <select name="id">
                    <option selected></option>
                  @foreach($employees as $employee)
	                  <option value="{{$employee->id}}">
	                   {{$employee->firstname}}  {{$employee->lastname}}
	                  </option>
	                @endforeach 
	              </select>
            </div>
            <div class="col-mx-2-md-2">
              <label for="From">Desde: </label>  
              <input type="date" id="DatePicker1" name="from">
            </div>
            <div class="col-mx-2-md-2">
              <label for="To">Hasta: </label> 
              <input type="date" id="DatePicker2" name="to">
            </div>
            <div class="col-md-2">
            <br>  
  	          <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
        <br>
        @if($var== -1)
        <h4>No se encuentran resultados para esta consulta</h4>
        @elseif(isset($dailyreports))
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Hora de Llegada</th>
              <th>Hora de Salida</th>
            </tr>
          </thead>
          <tbody>
          @foreach($dailyreports as $dailyreport)
            <tr>
              <td>{{$dailyreport->date}}</td>
              <td>{{$dailyreport->arrival_time}}</td>
              <td>{{$dailyreport->departure_time}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
        @endif
      </form>
    </div>
@endsection
