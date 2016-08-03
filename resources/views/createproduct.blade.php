@extends('layouts.loggedIn')

@section('title', 'Produkt erstellen')

@section('breadcrumbs')
    <a href="/receipts" class="breadcrumb">Quittungen</a>
    <a href="/receipt/{{ $ID }}/" class="breadcrumb">Quittung Nr.{{ $ID }}</a>
    @if(!empty($receipt_product['ID']))
        <a href="/receipt/new/" class="breadcrumb">Produkt bearbeiten</a>
    @else
        <a href="/receipt/new/" class="breadcrumb">Produkt hinzufügen</a>
    @endif
@endsection
@section('content')
@parent
<div class="container">
    @if(!empty($receipt_product['ID']))
    <form method="POST" action="/receipt/{{ $ID }}/receiptproduct/{{ $receipt_product['ID'] }}" >
        <input type="hidden" name="_method" value="PUT">
        @else
        <form action='/receipt/{{ $ID }}/product' method='POST'> 
            @endif
            <div class="row">

            </div>
            <div class="input-field col s12 m6">
                <input id="productname"  type="text" name="name"
                       @if(!empty($receipt_product))
                       value="{{ $receipt_product["Product"]["Name"] }}"                
                       @endif
                       /> 
                       <label for="productname">Name @if(!empty($errorMessages->name[0]))<span class="errormsg">{{ $errorMessages->name[0] }}</span>@endif</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="productquantiy"  type="text" name="quantity"
                       @if(!empty($receipt_product))
                       value="{{ $receipt_product["Quantity"] }}"                
                       @endif
                       />     
                       <label for="productquantiy">Anzahl @if(!empty($errorMessages->quantity[0]))<span class="errormsg">{{ $errorMessages->quantity[0] }}</span>@endif</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="producttotalprice"  type="text" name="totalPrice"
                       @if(!empty($receipt_product))
                       value="{{ $receipt_product["TotalPrice"] }}"                
                       @endif
                       />     
                       <label for="producttotalprice">Gesamtpreis (CHF) @if(!empty($errorMessages->totalPrice[0]))<span class="errormsg">{{ $errorMessages->totalPrice[0] }}</span>@endif</label>

            </div>  
            <button class="btn waves-effect waves-light" type="submit" name="action">
                Speichern
            </button>
        </form>

</div>

@endsection
