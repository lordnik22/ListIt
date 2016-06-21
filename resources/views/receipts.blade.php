@extends('layouts.loggedIn')

@section('title', 'Welcome')

@section('content')

@unless (Auth::check())
    You are not signed in.
@endunless

<a href="/createreceipt">Quittung hinzufügen</a>

Quittungen
@forelse ($receipts as $receipt)
    
    <a href="/receipt/{{ $receipt["ID"] }}" >{{ $receipt["Datum"] }}</a>
@empty
    <p>Keine Quittungen</p>
@endforelse


@endsection