@extends('layouts.loggedIn')

@section('title', 'Quittungen')

@section('content')

@unless (Auth::check())
You are not signed in.
@endunless
<div class="container">
    <form action="/receipts" method="GET">
        Quittung nach
        <div class="input-field">
            <select name="sortOption">                                
                <option value="Datum">Datum</option>                
            </select>
        </div>
        <input type="submit" value="sortieren" />
    </form>
    <div class="row">
        <div class="col s12 m12">
            <a href="/receipt/new">
                <div>
                    <img src="img/walros1.min.png" alt="Quittung hinzufügen"/>
                    Hinzufügen
                </div>
            </a>            
        </div>

        @forelse ($receipts as $receipt)
        <div class="receipt col s6 m4 l3">
            <a href="/receipt/{{ $receipt["ID"] }}" >
                <span>{{ reformat_date($receipt["Datum"]) }}</span>
                <span>Firma: {{ $receipt["Company"]["Name"] }}</span>
                <span>Region: {{ $receipt["ShopLocation"]["Region"] }}</span>
                <span>Land: {{ $receipt["ShopLocation"]["Country"] }}</span>
                <span>Strasse: {{ $receipt["ShopLocation"]["Street"] }}</span>
                <span>StrassenNr: {{ $receipt["ShopLocation"]["StreetNr"] }}</span>
                <span>Gesamtpreis: {{ number_format($receipt["TotalPrice"], 2) }}</span>
            </a>                
            <form action="/receipt/{{ $receipt["ID"] }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button>Löschen</button>
            </form>
        </div>                

        @empty
        <p>Keine Quittungen</p>
        @endforelse
    </div>
</div>
@endsection