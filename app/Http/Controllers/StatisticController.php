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
        var_dump($this->topProducts($request));
        return view('statistics', ['weekOverviewData' => $conv->getArrayWeekOverview($receipts)]);
    }
    public function topProducts(Request $request){
        $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
        
        $products = \ListIt\Receipt_Product::with('product.Name')
                    ->groupBy('Name')
                    ->sum('TotalPrice');
        //var_dump($products);
        return $products;
    }
    public function get(){
//        $topProducts = topProducts();
//        $weekOverview = weekOverview();
    }
}
