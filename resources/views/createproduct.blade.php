@extends('layouts.loggedIn')

@section('title', 'Produkt erstellen')

@section('content')
@parent
<form action='/createproduct' method='POST'>    
    <label>
        Name:
        <input type="text" name="name" />
    </label>

    <label>
        Anzahl:
        <input type="text" name="quantity" />        
    </label>
    
    <label>
        Gesamtpreis:
        <input type="text" name="totalPrice" />
    </label>    
    
    <input type="submit" />
</form>

@endsection
