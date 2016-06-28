@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('content')
<div id="addReceipt">
    <form method="POST" action="/createreceipt">
        <fieldset>
            <legend>Quittung erstellen</legend>
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