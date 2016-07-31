<form action="/receipts" method="GET">
    <div class="col">
        <h3>Suche</h3>
        <h6>Datum</h6>
        <div class="input-field col s4">
            <input id="searchyear" name="year" type="text" value="" />
            <label for="searchyear">Jahr</label>
        </div>
        <div class="input-field col s4">
            <input id="searchmonth" name="month" type="text" value="" />
            <label for="searchmonth">Monat</label>
        </div>
        <div class="input-field col s4">
            <input id="searchday" name="day" type="text" value="" />
            <label for="searchday">Tag</label>
        </div>
        <h6>Gesamtpreis</h6>
        <div id="range-input" class="range-field noUi-target noUi-ltr noUi-horizontal noUi-background">
        </div>

    </div>
    <div class="col">
        <h3>Sortierung</h3>
        <div class="input-field col s12">
            <select name="sortOption">                                
                <option value="Datum">Datum</option>                
            </select>
        </div>
        <button class="btn waves-effect waves-light" type="submit">
            Filtern
        </button>   
    </div>
</form>
<script>
var connectSlider = document.getElementById('range-input');

noUiSlider.create(connectSlider, {
	start: [20, 80],
	connect: false,
	range: {
            'min': 0,
            'max': 100
	}
});
</script>