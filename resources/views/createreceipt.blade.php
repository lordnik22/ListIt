@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('content')
<div id="addReceipt">        
        @if(!empty($receipt))
            <form method="POST" action="/createreceipt{{ $receipt["ID"] }}" >
        @else
            <form method="POST" action="/createreceipt" >        
        @endif
          
        <fieldset>
            <legend>Quittung erstellen</legend>
             <label>
                <span>Datum</span>
                <input type="datetime" name="datum" />
            </label> 
            <label>
                <span>Firma</span>
                <input type="text" name="company" />
            </label>
            <label>
                <span>Standort</span>
                <label>
                    <span>Region</span>
                    <input type="text" name="region" /> 
                </label>
                <label>
                    <span>Land</span>
                    <input type="text" name="country"/>
                </label>    
                <label>
                    <span>Strasse</span>
                    <input type="text" name="street" />
                </label>
                <label>
                    <span>StrassenNr</span>
                    <input type="text" name="streetNr" />
                </label>      
            </label>
            <input type="submit" value="Speichern" />
        </fieldset>
    </form>
</div>
@endsection