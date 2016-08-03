@extends('layouts.base.master')

@section('basestructure')
<nav>
    <div class="nav-wrapper">
        <a href="/receipts" class="brand-logo"><img src="/img/logoV2_0.png" alt="logo"/></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/receipts">Quittungen</a></li>
            <li><a href="/stats">Statistiken</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
        <div class='center'>
            @yield('breadcrumbs')
        </div>
    </div>
</nav>
@yield('content')
@endsection