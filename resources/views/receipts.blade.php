@extends('layouts.loggedIn')

@section('title', 'Quittungen')

@section('content')

@unless (Auth::check())
You are not signed in.
@endunless
<div class="container">
    <form action="/receipts" method="GET">
        <div class="input-field col s12">
            <select name="sortOption">                                
                <option value="Datum">Datum</option>                
            </select>
        </div>
        <button class="btn waves-effect waves-light" type="submit">
            Sortieren
        </button>
    </form>
    <div class="row">
        <div class="receipt add card col s6 m4 l3">
            <div class="card-content center">
                <a href="/receipt/new">
                    <i class="material-icons activator large">add</i>
                </a>
            </div>
        </div>

        @forelse ($receipts as $receipt)
        <div class="receipt card col s6 m4 l3">
            <div class="card-content waves-effect waves-block waves-light text">
                <a href="/receipt/{{ $receipt["ID"] }}" >
                    <span>{{ reformat_date($receipt["Datum"]) }}</span>
                    <span>Firma: {{ !empty($receipt["Company"]["Name"]) ? $receipt["Company"]["Name"] : "unbekannt" }}</span>
                    <span>Region: {{ !empty($receipt["ShopLocation"]["Region"]) ? $receipt["ShopLocation"]["Region"] : "unbekannt" }}</span>
                    <span>Land: {{ !empty($receipt["ShopLocation"]["Country"]) ? $receipt["ShopLocation"]["Country"] : "unbekannt" }}</span>
                    <span>Gesamtpreis: {{ !empty($receipt["TotalPrice"]) ? $receipt["TotalPrice"] : "unbekannt" }}</span>
                </a>   
            </div>
            <div class="card-action">
                <form action="/receipt/{{ $receipt["ID"] }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button><i class="material-icons activator right">delete</i></button>
                </form>
                <a href="/receipt/{{ $receipt["ID"] }}/update"><i class="material-icons">edit</i></a>
                <i class="material-icons activator right">more_vert</i>
            </div>
            <div class="card-reveal">
                <i class="material-icons card-title right">close</i>
                <table>
                    <thead>
                        <th>Produkt</th>
                        <th>Total Preis</th>
                    </thead>
                    <tbody>
                        @forelse ($receipt["Receipt_Products"] as $receipt_product)
                        <tr>
                            <td>{{ $receipt_product["Product"]['Name'] }}</td>                      
                            <td>{{ number_format($receipt_product["TotalPrice"], 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>Keine Produkte</td>                      
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>

        </div>                

        @empty
        @endforelse
    </div>
</div>
@endsection