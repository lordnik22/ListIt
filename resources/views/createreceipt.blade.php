@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('content')
<div class="container">        

@if(!empty($receipt))
    <form method="POST" action="/receipt/{{ $receipt["ID"] }}" >
    <input type="hidden" name="_method" value="PUT">
@else
    <form method="POST" action="/receipt" >        
@endif
    <div class="row">
        <h3>Quittung</h3>
        <div class="col s12 m6">
            <div class="input-field col s12 m6">
                <input id="receiptdatum"  type="datetime-local" name="datum" value="" />
                <label for="receiptdatum">Datum</label>
            </div>

            <div class="input-field col s12 m6">
                <input id="receiptcompany"  type="text" name="company"
                    @if(!empty($receipt))
                    value="{{ $receipt["Company"]["Name"] }}"                
                    @endif
                    />
                <label for="receiptcompany">Firma</label>
            </div>
        
            <h4>Standort</h4>

            <div class="input-field col s12 m6">
                <input id="receiptcompany"  type="text" name="region"
                    @if(!empty($receipt))
                    value="{{ $receipt["ShopLocation"]["Region"] }}"
                    @endif                           
                    />
                <label for="receiptregion">Region</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="receiptcountry"  type="text" name="country"
                    @if(!empty($receipt))
                    value="{{ $receipt["ShopLocation"]["Country"] }}"
                    @endif                           
                    />
                <label for="receiptcountry">Land</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="receiptstreet"  type="text" name="street"
                    @if(!empty($receipt))
                    value="{{ $receipt["ShopLocation"]["Street"] }}"
                    @endif                           
                    />
                <label for="receiptstreet">Strasse</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="receiptstreetnr"  type="text" name="streetNr"
                           @if(!empty($receipt))
                           value="{{ $receipt["ShopLocation"]["StreetNr"] }}"
                           @endif                           
                           />
                <label for="receiptstreetnr">StrassenNr</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">
                Speichern
            </button>
        </div>               
    </div>
    </form>
</div>
@endsection