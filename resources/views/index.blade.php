@extends('layouts.loggedOut')

@section('title', 'Welcome')

@section('content')
    <div id="mainBlock">
        @include('login')
        <div class="verticalLine">
        </div>
        @include('register')
    </div>
@endsection