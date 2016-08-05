    <canvas id="weekoverviewchart"></canvas>

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

<script type="text/javascript">
    drawChart({!! json_encode($weekOverviewData) !!});
    function drawWeekOverviewChart(chartData) {
    $(function () {

    //Converting Object to an Array
    var dataArray = $.map(chartData, function (value, index) {
    return [value];
    });
            //Get HTML-Element who displays the chart
            var ctx = document.getElementById("weekoverviewchart");
            //Creation and configuration of the chart
            var myChart = new Chart(ctx, {
            type: 'bar',
                    data: {
                    labels: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
                            datasets: [{
                            label: 'Durchschnittliche Ausgaben pro Wochentag',
                                    data: dataArray,
                                    backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                            }]
                    },
                    options: {
                    scales: {
                    yAxes: [{
                    ticks: {
                    suggestedMax: 40,
                            stepSize: 10,
                            beginAtZero: true
                    }
                    }]
                    },
                            tooltips: {
                            enabled: false
                            }
                    }
            });
    });
    }
    
</script>