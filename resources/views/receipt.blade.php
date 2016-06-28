@extends('layouts.loggedIn')

@section('title', 'Welcome')

@section('content')

    @unless (Auth::check())
        You are not signed in.
    @endunless
     <a href="/receipts">Quittungen</a>
    {{ $receipt["ID"] }}
    
    <a href="/receipt/{{ $receipt["ID"] }}/createproduct">Produkt hinzufügen</a>
    <div class="receiptBlock">
        <ul>
            
            @forelse ($receipt["Receipt_Products"] as $receipt_product)                
                <li>Produkt: {{ $receipt_product["Product"]['Name'] }}
                    Gesamtpreis: {{ number_format($receipt_product["TotalPrice"], 2) }}                                       
                    Anzahl: {{ $receipt_product["Quantity"] }}
                    <form action="/receipt/{{ $receipt["ID"] }}/receiptproduct/{{ $receipt_product["ID"] }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button>Löschen</button>
                    </form>
                </li>
            @empty
                <p>Kein Produkt</p>
            @endforelse
        </ul>
    </div>
@endsection