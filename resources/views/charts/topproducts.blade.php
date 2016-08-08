<div class='row'>
    <canvas id="topproductschart"></canvas>
</div>
<div class='row'>
    <select name="dateOption">                                
        <option value="sinceYearBegin">nach Kosten</option>
        <option value="sinceBegin">nach Menge</option>
    </select>
</div>
<script type="text/javascript">
    drawTopProductsChart({!! ($topProductsData) !!});
            function drawTopProductsChart(chartData) {
                $(function () {

                    //Converting Object to an Array
                    var labelArray = [];
                    var dataArray = $.map(chartData, function (value, index) {
                        labelArray.push(value.Name);
                        return [value.TotalPrice];
                    });

                    //Get HTML-Element who displays the chart
                    var ctx = document.getElementById("topproductschart");

                    //Creation and configuration of the chart
                    var myChart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: {
                            labels: labelArray,
                            datasets: [{
                                    label: 'Top 10 Produkte',
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