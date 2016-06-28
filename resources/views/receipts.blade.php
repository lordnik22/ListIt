@extends('layouts.loggedIn')

@section('title', 'Welcome')

@section('content')

    <a href="/createreceipt">Quittung hinzufügen</a>

    @unless (Auth::check())
        You are not signed in.
    @endunless

    <h1>Quittungen</h1>
    <div id="receiptsBlock">
        @forelse ($receipts as $receipt)
            <div class="receiptBlock">
                <a href="/receipt/{{ $receipt["ID"] }}" >
                    <span>Datum: {{ $receipt["Datum"] }}</span>
                    <span>Firma: {{ $receipt["Company"]["Name"] }}</span>
                    <span>Region: {{ $receipt["ShopLocation"]["Region"] }}</span>
                    <span>Land: {{ $receipt["ShopLocation"]["Country"] }}</span>
                    <span>Strasse: {{ $receipt["ShopLocation"]["Street"] }}</span>
                    <span>StrassenNr: {{ $receipt["ShopLocation"]["StreetNr"] }}</span>
                    <span>Gesamtpreis: {{ number_format($receipt["TotalPrice"], 2) }}</span>
                </a>
            </div>                
        
        @empty
            <p>Keine Quittungen</p>
        @endforelse
    </div>
@endsection