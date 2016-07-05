@extends('layouts.loggedIn')

@section('title', 'Produkt erstellen')

@section('content')
@parent

@if(!empty($receipt))
            <form method="POST" action="/receipt/{{ $receipt["ID"] }}/update" >
            <input type="hidden" name="_method" value="PUT">
        @else
            <form action='/receipt/{{ $ID }}/product' method='POST'> 
        @endif
       
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
