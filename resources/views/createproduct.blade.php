@extends('layouts.loggedIn')

@section('title', 'Produkt erstellen')

@section('content')
@parent
<div class="container">
    <h1>Produkt</h1>
    @if(!empty($receipt_product))
        <form method="POST" action="/receipt/{{ $ID }}/receiptproduct/{{ $receipt_product["ID"] }}" >
        <input type="hidden" name="_method" value="PUT">
    @else
        <form action='/receipt/{{ $ID }}/product' method='POST'> 
    @endif
           <div class="input-field col s12 m6">
                <input id="productname"  type="text" name="name"
                    @if(!empty($receipt_product))
                        value="{{ $receipt_product["Product"]["Name"] }}"                
                    @endif
                    /> 
                <label for="productname">Name</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="productquantiy"  type="text" name="quantity"
                    @if(!empty($receipt_product))
                        value="{{ $receipt_product["Quantity"] }}"                
                    @endif
                    />     
                <label for="productquantiy">Anzahl</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="producttotalprice"  type="text" name="totalPrice"
                    @if(!empty($receipt_product))
                        value="{{ $receipt_product["TotalPrice"] }}"                
                    @endif
                />     
                <label for="producttotalprice">Gesamtpreis</label>
            </div>  
            <button class="btn waves-effect waves-light" type="submit" name="action">
                Speichern
            </button>
        </form>
    
</div>

@endsection
