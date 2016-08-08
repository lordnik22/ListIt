<div class='row'>
    <table>
        <thead>
            <tr>
                <th>auswahl</th>
                <th>täglich</th>
                <th>wöchentlich</th>
                <th>monatlich</th>
                <th>jährlich</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($compareYearsData[0]))
                @foreach($compareYearsData as $YearData)
                <tr>
                    <td>{{ $YearData['Year']}}</td>
                    <td>{{ round($YearData['TotalPrice'] / 365, 2) }}</td>
                    <td>{{ round($YearData['TotalPrice'] / 52, 2) }}</td>
                    <td>{{ round($YearData['TotalPrice'] / 12, 2) }}</td>                              
                    <td>{{ round($YearData['TotalPrice'], 2) }}</td>
                </tr>
                @endforeach
            @endif           
        </tbody>
    </table>
</div>
<div class='row'>

    <div class='row'>
        <div class='input-field col s4'>
            <input id='firstyear' type="number" name='firstyear'/>
            <label for='firstyear'>1. Jahr</label>
        </div>
        <div class='input-field col s4'>
            <input id='secondyear' type="number" name='secondyear'/>
            <label for='secondyear'>2. Jahr</label>
        </div>
        <div class='col s3'>
            <button id='but_compareYears' class="btn waves-effect waves-light" type="submit">
                Vergleichen
            </button>
        </div>
    </div>

</div>
<script type="text/javascript">
    $("#but_compareYears").bind("click", function () {
        var firstYear = $("#firstyear").val();
        var secondYear = $("#secondyear").val();

        $.post("/compareYears", {firstyear: firstYear, secondyear: secondYear})
                .done(function (data) {
                    $("#compareYears").html(data)
                });
    });
</script>  