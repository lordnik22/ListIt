<form action="/receipts" method="GET">
    <div class="col s12">
        <h2>Suche</h2>
    </div>
    <div class="col s12">
        <div class="col s6">
            <div class="col s12">
                <div class="col s6">
                    <h6>Datum</h6>
                    <div class="input-field col s4">
                        <input id="searchyear" name="year" type="number" value="" />
                        <label for="searchyear">Jahr</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="searchmonth" name="month" type="number" value="" />
                        <label for="searchmonth">Monat</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="searchday" name="day" type="number" value="" />
                        <label for="searchday">Tag</label>
                    </div>
                </div>
                <div class="col s6">
                    <h6>Einkaufsort</h6>
                    <div class="input-field col s6">
                        <input id="searchcompany" name="company" type="text" value="" />
                        <label for="searchcompany">Firma</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="searchregion" name="region" type="text" value="" />
                        <label for="searchregion">Region</label>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="col s12">
                    <h6>Gesamtpreis</h6>
                    <div class="col s12">
                        <input id="mintotalPrice" class="col s2" min="0" name="mintotalPrice" type="number" value="" />
                        <div class="col s8">
                            <div id="range-input" class="range-field noUi-target noUi-ltr noUi-horizontal noUi-background">
                            </div>
                        </div>
                        <input id="maxtotalPrice" class="col s2" min="0" name="maxtotalPrice" type="number" value="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="col s12">
                <h6>Sortierung</h6>
                <div class="input-field col s12">
                    <select class="browser-default" name="sortOption">                                
                        <option value="Datum">Datum</option>                
                    </select>
                </div>
            </div>
        </div>        
    </div>
    <div class="col s12">
        <div class="col push-s10">
            <button class="btn waves-effect waves-light  push-s5" type="submit">
                Filtern
            </button>
        </div>
    </div>
</form>
<script>
    var connectSlider = document.getElementById('range-input');

    noUiSlider.create(connectSlider, {
        start: [50, 250],
        connect: false,
        range: {
            'min': 0,
            'max': 300
        }
    });

    var minInputNumber = document.getElementById('maxtotalPrice');
    var maxInputNumber = document.getElementById('mintotalPrice');

    connectSlider.noUiSlider.on('update', function (values, handle) {

        var value = values[handle];

        if (handle) {
            minInputNumber.value = value;
        } else {
            maxInputNumber.value = value;
        }
    });

    maxInputNumber.addEventListener('change', function () {
        connectSlider.noUiSlider.set([this.value, null]);
    });

    minInputNumber.addEventListener('change', function () {
        connectSlider.noUiSlider.set([null, this.value]);
    });
</script>