@extends('layouts.base.master')

@section('basestructure')
    <body id="loggedOut">
        <a href='/login'>Login</a>
        <a href='/register'>Registerireireirier</a>
        @yield('content')
    </body>
@endsection