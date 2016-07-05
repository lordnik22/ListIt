@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('content')
<div id="addReceipt">        
        @if(!empty($receipt))
            <form method="POST" action="/receipt/{{ $receipt["ID"] }}/updatereceipt" >
            <input type="hidden" name="_method" value="PUT">
        @else
            <form method="POST" action="/createreceipt" >        
        @endif
          
        <fieldset>
            <legend>Quittung erstellen</legend>
             <label>
                <span>Datum</span>
                <input type="datetime-local" name="datum"/>
            </label> 
            <label>
                <span>Firma</span>
                <input type="text" name="company"
                    @if(!empty($receipt))
                        value="{{ $receipt["Company"]["Name"] }}"                
                    @endif
                />
            </label>
            <label>
                <span>Standort</span>
                <label>
                    <span>Region</span>
                    <input type="text" name="region"
                        @if(!empty($receipt))
                            value="{{ $receipt["ShopLocation"]["Region"] }}"
                        @endif                           
                    /> 
                </label>
                <label>
                    <span>Land</span>
                    <input type="text" name="country"
                        @if(!empty($receipt))
                            value="{{ $receipt["ShopLocation"]["Country"] }}"
                        @endif                           
                    /> 
                </label>    
                <label>
                    <span>Strasse</span>
                    <input type="text" name="street"
                        @if(!empty($receipt))
                            value="{{ $receipt["ShopLocation"]["Street"] }}"
                        @endif                           
                    />
                </label>
                <label>
                    <span>StrassenNr</span>
                    <input type="text" name="streetNr"
                        @if(!empty($receipt))
                            value="{{ $receipt["ShopLocation"]["StreetNr"] }}"
                        @endif                           
                    />
                </label>      
            </label>
            <input type="submit" value="Speichern" />
        </fieldset>
    </form>
</div>
@endsection