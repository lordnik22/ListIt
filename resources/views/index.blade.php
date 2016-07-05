@extends('layouts.loggedOut')

@section('title', 'Welcome')

@section('content')
<div class="container login">
    <div class="container-blur">
    </div>
        
    <div class="row">
        <div class="col s12 m6">
            @include('login')
        </div>
        <div class="col s12 m6">
            @include('register')
        </div>
    </div>
</div>
@endsection