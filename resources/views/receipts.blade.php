@extends('layouts.loggedIn')

@section('title', 'Welcome')

@section('content')
    @unless (Auth::check())
        You are not signed in.
    @endunless

    <a href="">Quittung hinzufügen</a>

    <h1>Quittungen</h1>
    <div class="receiptBlock">
        @forelse ($receipts as $receipt)
            <a href="/receipt/{{ $receipt["ID"] }}" >{{ $receipt["Datum"] }}</a>
        @empty
            <p>Keine Quittungen</p>
        @endforelse
    </div>
@endsection