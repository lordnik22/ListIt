@extends('layouts.loggedIn')

@section('title', 'Welcome')

@section('content')

@unless (Auth::check())
    You are not signed in.
@endunless

{{ $receipt["ID"] }}

<button>Produkt hinzufügen</button>

@forelse ($receipt["Receipt_Products"] as $receipt_product)
    <li>{{ $receipt_product["TotalPrice"] }}</li>
@empty
    <p>Kein Produkt</p>
@endforelse

@endsection