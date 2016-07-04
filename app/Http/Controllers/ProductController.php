<?php

namespace ListIt\Http\Controllers;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use \ListIt\Services\ConversionService;

class ProductController extends Controller {
     
    public function create(Request $request, $id) {                        
        $this->validate($request, [
            'name' => 'required',
            'totalPrice' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1'            
        ]);
        
        \DB::transaction(function () use ($request, $id) {
            $receipt = \ListIt\Receipt::findOrFail($id);                                

            $product = \ListIt\Product::firstOrCreate(['Name'=>$request->input('name')]);

            $receipt_product = new \ListIt\Receipt_Product();
            $receipt_product->receiptID = $receipt->ID;
            $receipt_product->productID = $product->ID;
            $receipt_product->TotalPrice = $request->input('totalPrice');
            $receipt_product->Quantity = $request->input('quantity');
            $receipt_product->save();
        });
        
        return redirect('/receipt/'. $id);
    }
}
