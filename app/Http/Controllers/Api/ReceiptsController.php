<?php

namespace ListIt\Http\Controllers\Api;

use ListIt\Http\Controller;

class UserController extends Controller {
    public function create(Request $request) {
        
    }
    public function get($id) {        
        $receipt = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')->findOrFail($id);
        return json_encode($this->conv->getJsonReceipt($receipt), JSON_PRETTY_PRINT);
    }
}
