<?php

namespace ListIt\Http\Controllers;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use ListIt\Services\ConversionService;
use ListIt\Services\ValidationService;

class StatisticController extends Controller {
    public function weekOverview(ConversionService $conv, Request $request) {
        $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
        
        $receipts = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')
                ->where('UserID', $user->ID)->raw("MONTH(Datum)", '=', date('n'))
                ->get();                        
        
        var_dump($receipts);
        
        return view('statistics', ['data' => $conv->getArrayWeekOverview($receipts)]);
    }
    /*
    <option value="sinceBegin">seit Anfang</option>
    <option value="sinceYearBegin">seit Jahressstart</option>
    <option value="sinceMonthBegin">seit Monatsstart</option>
    <option value="sinceWeekBegin">seit Wochenstart</option>
    <option value="lastWeek">letztes Jahr</option>
    <option value="lastMonth">letzter Monat</option>
    <option value="lastYear">letzte Woche</option>  
    */
}
