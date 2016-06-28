@extends('layouts.loggedOut')

@section('title', 'Login')

@section('content')
    <div id="mainBlock">
        @include('login')
        <div class="verticalLine">
        </div>
        @include('register')
    </div>
@endsection