@extends('layouts.master')
@section('title', 'Reportes')
@section('content')
    <div class="container">
@include('layouts.partials.flashmessage')

    {{ Breadcrumbs::render('dailyreports.addfile') }}
        <h2 class="text-center">
            Excel/CSV Import
        </h2>
 
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
</div>
@endif
 
<form action="{{ route('importfile') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    Choose your xls/csv File : <input type="file" name="file" class="form-control">
 
    <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%">
</form>
 
</div>
@endsection