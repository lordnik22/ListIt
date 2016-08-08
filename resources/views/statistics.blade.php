@extends('layouts.loggedIn')

@section('title', 'Quittung')

@section('content')
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col s6">
                @include('charts.weekoverview')
            </div>
            <div id='compareYears' class="col s6">
                @include('charts.compareYears')
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                @include('charts.topproducts')
            </div>
        </div>
    </div>
</div>  
@endsection


