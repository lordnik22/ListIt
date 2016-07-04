@extends('layouts.loggedOut')

@section('title', 'Welcome')

@section('content')
    <div id="mainBlock">
        @include('login')
        @include('register')
    </div>
@endsection