@extends('layouts.loggedIn')

@section('title', 'Welcome')

@section('content')

    <a href="/createreceipt">Quittung hinzufügen</a>

    @unless (Auth::check())
        You are not signed in.
    @endunless

    <h1>Quittungen</h1>
    <div class="receiptBlock">
        @forelse ($receipts as $receipt)
            <a href="/receipt/{{ $receipt["ID"] }}" >
                Datum: {{ $receipt["Datum"] }}
                Firma: {{ $receipt["Company"]["Name"] }}
                Region: {{ $receipt["ShopLocation"]["Region"] }} 
                Land: {{ $receipt["ShopLocation"]["Country"] }}
                Strasse: {{ $receipt["ShopLocation"]["Street"] }}
                StrassenNr: {{ $receipt["ShopLocation"]["StreetNr"] }}
                Gesamtpreis: {{ number_format($receipt["TotalPrice"], 2) }}
                
            </a>
        
        @empty
            <p>Keine Quittungen</p>
        @endforelse
    </div>
@endsection