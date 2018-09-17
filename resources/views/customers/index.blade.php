@extends('layouts.master')
@section('title', 'Clientes')
@section('content')
<div class="container">
@include('layouts.partials.flashmessage')

  {{ Breadcrumbs::render('customers.index') }}

  <h2 class="mb-3">Lista Clientes</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>E-mail</th>
        <th>Cliente</th>
        @if(auth()->user())
        <th colspan="2">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      
      @foreach($customers as $customer)
      <tr>
        <td>{{$customer['name']}}</td>
         <td>{{$customer['email']}}</td>
        @if(auth()->user())
        <td><a href="{{action('CustomerController@edit', $customer['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form id="form-customers-id" action="{{action('CustomerController@destroy', $customer['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">
              Delete
            </button>
          </form>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
@if(auth()->user())
  <div class="col-md-4">
    <a href="{{action('CustomerController@create')}}" class="btn btn-warning">Add</a>
  </div>
@endif
</div>
@endsection