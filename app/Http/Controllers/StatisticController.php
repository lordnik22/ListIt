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

        return $conv->getArrayWeekOverview($receipts);
    }

    public function topProducts(Request $request) {
        $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();

        $products = \ListIt\Receipt::join('receipt_product', 'receipt.ID', '=', 'receipt_product.ReceiptID')
                ->join('product', 'receipt_product.ProductID', '=', 'product.ID')
                ->where('receipt.UserID', $user->ID)
                ->groupBy('receipt_product.ProductID')
                ->selectRaw('product.Name as Name, SUM(TotalPrice) AS TotalPrice')
                ->orderBy('TotalPrice', 'DESC')
                ->take(10)
                ->get();

        return $products->toJson();
    }

    public function compareYears(Request $request) {
        $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
        
        $totalPrices = \ListIt\Receipt::join('receipt_product', 'receipt.ID', '=', 'receipt_product.ReceiptID')
                ->whereRaw('SUBSTRING(Datum, 1,4) = ?', [$request->input('firstyear')])
                ->orWhereRaw('SUBSTRING(Datum, 1,4) = ?', [$request->input('secondyear')])
                ->selectRaw('SUBSTRING(Datum, 1,4) AS Year, SUM(TotalPrice) AS TotalPrice')
                ->groupBy('Year')
                ->get();
        
        $totalPrice = \ListIt\Receipt_Product::selectRaw("'Alle Jahre' AS Year, SUM(TotalPrice) AS TotalPrice")
                    ->get();
        
       //var_dump($totalPrices);
        $totalPrices->merge($totalPrice);
       
        return view('charts.compareYears', ['compareYearsData' => $totalPrices]);
    }

    public function get(ConversionService $conv, Request $request) {
        $topProducts = $this->topProducts($request);
        $weekOverview = $this->weekOverview($conv, $request);

        return view('statistics', ['weekOverviewData' => $weekOverview, 'topProductsData' => $topProducts]);
    }

}
