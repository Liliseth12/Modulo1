@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="container">
@include('layouts.partials.flashmessage')

{{ Breadcrumbs::render('home') }}

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                    <?php if(auth()->user()->isAdmin == 1){?>
                    <div class="panel-body">
                    </div><?php } else echo '<div class="panel-heading">Normal User</div>';?>
                </div>
        </div>
    </div>
</div>
@endsection