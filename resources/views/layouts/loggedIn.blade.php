@extends('layouts.base.master')

@section('basestructure')
    <body>
        <div id="nav">
            <div id="boxrowleft">
                <div class="boxsmall"></div>
                <div class="boxmiddle"></div>
                <a id="profile" ><img  /></a>
            </div>
            <div id="navbar">
                <a href="/home">Home</a>
                <a href="/login">Logout</a>
            </div>
            <div id="boxrowrigth">
                <a id="profile" ><img  /></a>
                <div class="boxmiddle"></div>
                <div class="boxsmall"></div>                                
            </div>
        </div>
        @yield('content')
    </body>
@endsection