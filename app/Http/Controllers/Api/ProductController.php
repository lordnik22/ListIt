<?php

namespace ListIt\Http\Controllers\Api;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;

class ProductController extends Controller {
    public function create(Request $request) {
        $this->validate($request, [
            'productName' => 'required',
            'totalPrice' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'receiptID' => 'required|exists:receipt,ID'
        ]);                                        
        
        
        \DB::transaction(function () use ($request) {
            $receipt = \ListIt\Receipt::findOrFail($request->input('receiptID'));                                

            $product = \ListIt\Product::firstOrCreate(['Name'=>$request->input('productName')]);

            $receipt_product = new \ListIt\Receipt_Product();
            $receipt_product->receiptID = $receipt->ID;
            $receipt_product->productID = $product->ID;
            $receipt_product->TotalPrice = $request->input('totalPrice');
            $receipt_product->Quantity = $request->input('quantity');
            $receipt_product->save();
        });
    }
    
    public function get() {        
        return \ListIt\Product::all();    
    }
}
