@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('content')
@parent
<form method="POST" action="/createreceipt">
    Firma:
    <input type="text" name="company" /></br>
    
    Standort:
    Land: <input type="text" name="country"/>
    Region: <input type="text" name="region" />    
    Strasse: <input type="text" name="street" />
    StrassenNr <input type="text" name="streetNr" />   
      
    <input type="submit" value="Speichern" />
</form>
@endsection