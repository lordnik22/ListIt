<?php

namespace ListIt\Http\Controllers\Api;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use \ListIt\Services\ConversionService;

class ReceiptController extends Controller {
    
   
    public function create(Request $request) {
        
    }
    
    public function get(ConversionService $conv) {
        return json_encode(\ListIt\Receipt::with('receipt_products', 'receipt_products.product')->get()->map([$conv, 'getJsonReceipt']), JSON_PRETTY_PRINT);        
        
        /* return json_encode(array_merge(\ListIt\Receipt::with('receipt_products', 'receipt_products.product')->get()->map(function($receipt) {
          return getjsonReceipt($receipt);
          })->toArray(), ['SQLQueries' => \DB::getQueryLog()]), JSON_PRETTY_PRINT); */
    }
    
    public function getOne(ConversionService $conv, $id) {        
        $receipt = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')->findOrFail($id);
        return json_encode($conv->getArrayReceipt($receipt), JSON_PRETTY_PRINT);
    }
}
