@extends('layouts.loggedIn')

@section('title', 'Quittung')

@section('content')
<div class="container">
    <form action="/stats" method="POST">
        <div class="input-field col s12">
            <select name="dateOption">                                
                <option value="sinceBegin">seit Anfang</option>
                <option value="sinceYearBegin">seit Jahressstart</option>
                <option value="sinceMonthBegin">seit Monatsstart</option>
                <option value="sinceWeekBegin">seit Wochenstart</option>
                <option value="lastWeek">letztes Jahr</option>
                <option value="lastMonth">letzter Monat</option>
                <option value="lastYear">letzte Woche</option>                
            </select>
        </div>
    </form>

    <canvas id="myChart" width="300" height="100"></canvas>   
    <canvas id="cakeChart" width="600" height="100"></canvas>   

    <script>
        drawChart({!! json_encode($data) !!});
        cakeChart();
    </script>
</div>
@endsection


