@extends('layouts.base.master')

@section('basestructure')
    <nav>
        <div class="navboxes">
            <div class="boxsmall"></div>
            <div class="boxmiddle"></div>
            <div class="boxlarge"></div>
        </div>
        <div class="navbar">
            <a href="/receipts">Quittungen</a>
            <a href="/index">Logout</a>
        </div>
        <div class="navboxes">
            <div class="boxlarge"></div>
            <div class="boxmiddle"></div>
            <div class="boxsmall"></div>                                
        </div>
    </nav>
    @yield('content')
@endsection