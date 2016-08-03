@extends('layouts.loggedIn')

@section('title', 'Quittung erstellen')

@section('breadcrumbs')
    <a href="/receipts/" class="breadcrumb">Quittungen</a>
    @if(!empty($receipt['ID']))
        <a href="/receipt/new/" class="breadcrumb">Quittung bearbeiten</a>
    @else
        <a href="/receipt/new/" class="breadcrumb">Quittung hinzufügen</a>
    @endif
@endsection

@section('content')
<div class="container">        

@if(!empty($receipt['ID']))
    <form method="POST" action="/receipt/{{ $receipt["ID"] }}" >
    <input type="hidden" name="_method" value="PUT">
@else
    <form method="POST" action="/receipt" >        
@endif
    <div class="row">
        <h3>Quittung</h3>
        <div class="col s12 m6">
           
            <div class="input-field col s12 m6">
                <input id="receiptdatum" class="datepicker" type="date" name="datum" 
                    @if(!empty($receipt))
                    value="{{ $receipt["Datum"] }}"                
                    @endif
                    />
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
    <script>
        $('.datepicker').pickadate({
            selectMonths: true,
            monthsFull: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
            weekdaysFull: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
            weekdaysShort: ['So', 'Mo', 'Di', 'Mit', 'Do', 'Fr', 'Sa'],

            today: 'Heute',
            clear: 'Clear',
            close: 'Close',

            labelMonthNext: 'Nächster Monat',
            labelMonthPrev: 'Vorheriger Monat',
            labelMonthSelect: 'Wähle Monat',
            labelYearSelect: 'Wähle Jahr',
            
            format: 'yyyy-mm-dd',
            selectYears: 15
      });
    </script>
</div>


@endsection