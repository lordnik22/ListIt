@extends('layouts.loggedOut')

@section('title', 'Login')

@section('content')
    <div id="mainBlock">
        @include('login')
        @include('register')
    </div>
@endsection