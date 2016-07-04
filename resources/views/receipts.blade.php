@extends('layouts.loggedIn')

@section('title', 'Quittungen')

@section('content')

    @unless (Auth::check())
        You are not signed in.
    @endunless
    <div id="receiptsBlock">
        <a href="/createreceipt">
            <div class="receiptBlock">
                <img src="img/walros1.min.png" alt="Quittung hinzufügen"/>
                Hinzufügen
            </div>
        </a>
        @forelse ($receipts as $receipt)
            <div class="receiptBlock">
                <a href="/receipt/{{ $receipt["ID"] }}" >
                    <span>{{ $receipt["Datum"] }}</span>
                    <span>Firma: {{ $receipt["Company"]["Name"] }}</span>
                    <span>Region: {{ $receipt["ShopLocation"]["Region"] }}</span>
                    <span>Land: {{ $receipt["ShopLocation"]["Country"] }}</span>
                    <span>Strasse: {{ $receipt["ShopLocation"]["Street"] }}</span>
                    <span>StrassenNr: {{ $receipt["ShopLocation"]["StreetNr"] }}</span>
                    <span>Gesamtpreis: {{ number_format($receipt["TotalPrice"], 2) }}</span>
                </a>
                <a href="/receipt/{{ $receipt["ID"] }}/deletereceipt">Löschen</a>
            </div>                
        
        @empty
            <p>Keine Quittungen</p>
        @endforelse
    </div>
@endsection