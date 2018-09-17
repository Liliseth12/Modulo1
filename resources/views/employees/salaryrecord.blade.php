@extends('layouts.master')
@section('title', 'Salario')
@section('content')
  <div class="container">
    {{ Breadcrumbs::render('salaries', $employee) }}
    <tbody>
      <h2 class="mb-3">
          Historial de Salarios de:   
          {{$employee->firstname}} 
          {{$employee->lastname}}
           @php //dd($employee); @endphp
      </h2>
      <form method="post" action="{{url('salaries')}}" enctype="multipart/form-data">
      @csrf
        <div>
          <input type="hidden" name="id" value="{{$employee->id}}">
          <label for="From">Desde: </label>  
              <input type="date" id="DatePicker1" name="from">
          <label for="To">Hasta: </label> 
              <input type="date" id="DatePicker2" name="to">   

          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
      <br>
      <div>

      @if(isset($var)&& $var == -1)
      <h4>No se encuentran resultados para esta consulta</h4>
      @elseif(empty($filters))
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>A la fecha</th>
              <th>Salario</th>
            </tr>
          </thead> 
          <tbody>
              @foreach($employee->salaries as $salary)
              <tr>
                <td>{{$salary->pivot->date}}</td>
                <td>{{$salary->amount}} Bs.</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      @else
          <h4>Resultados de la búsqueda:</h4>
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
              <th>A la fecha</th>
              <th>Salario</th>
            </tr>
          </thead> 
          <tbody>
            @foreach($filters as $filter)
            <tr>
              <td>{{$filter}}</td>
              @foreach($amounts as $amount)
                <td>{{$amount}}</td>
              @endforeach
            </tr>
            @endforeach
        @endif
      </div>  
  </div>
@endsection
