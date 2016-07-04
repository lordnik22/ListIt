@extends('layouts.loggedOut')

@section('title', 'Welcome')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s6">
            @include('login')
        </div>
        <div class="col s6">
            @include('register')
        </div>
    </div>
</div>
@endsection