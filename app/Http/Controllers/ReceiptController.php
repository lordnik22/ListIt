<?php

namespace ListIt\Http\Controllers;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use \ListIt\Services\ConversionService;

class ReceiptController extends Controller {
        
    public function get(ConversionService $conv) {
        $receipts = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')->get()->map([$conv, 'getJsonReceipt']);
        
        return view('receipts', ['receipts' => $receipts]);
    }
    
    public function getOne(ConversionService $conv, $id) {        
        $receipt = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')->findOrFail($id);
        return view ('receipt', ['receipt' => $conv->getJsonReceipt($receipt)]);
    }
}
