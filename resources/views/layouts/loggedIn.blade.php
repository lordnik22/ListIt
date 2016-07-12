@extends('layouts.base.master')

@section('basestructure')
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/receipts">Quittungen</a></li>
            <li><a href="/stats">Statistiken</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </div>
</nav>
@yield('content')
@endsection