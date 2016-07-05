@extends('layouts.loggedIn')

@section('title', 'Produkt erstellen')

@section('content')
@parent

@if(!empty($receipt_product))
            <form method="POST" action="/receipt/{{ $ID }}/receiptproduct/{{ $receipt_product["ID"] }}" >
            <input type="hidden" name="_method" value="PUT">
        @else
            <form action='/receipt/{{ $ID }}/product' method='POST'> 
        @endif
       
    <label>
        Name:
        <input type="text" name="name"
            @if(!empty($receipt_product))
                value="{{ $receipt_product["Product"]["Name"] }}"                
            @endif
        />
    </label>

    <label>
        Anzahl:
        <input type="text" name="quantity"
            @if(!empty($receipt_product))
                value="{{ $receipt_product["Quantity"] }}"                
            @endif
        />       
    </label>
    
    <label>
        Gesamtpreis:
        <input type="text" name="totalPrice"
            @if(!empty($receipt_product))
                value="{{ $receipt_product["TotalPrice"] }}"                
            @endif
        />  
    </label>    
    
    <input type="submit" />
</form>

@endsection
