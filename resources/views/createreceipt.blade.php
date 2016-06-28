@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('content')
@parent
<form method="POST" action="/createreceipt">
    <label>
        <span>Firma</span>
        <input type="text" name="company" />
    </label>
    <label>
        <span>Datum</span>
        <input type="datetime-local" name="datum" />
    </label>
    <span>Standort</span>
    <label>
        <span>Region</span>
        <<input type="text" name="region" /> 
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
    <input type="submit" value="Speichern" />
</form>
@endsection