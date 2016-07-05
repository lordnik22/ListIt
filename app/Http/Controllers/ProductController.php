<?php

namespace ListIt\Http\Controllers;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use ListIt\Services\ValidationService;

class ProductController extends Controller {
     
    public function create(ValidationService $val, Request $request, $id) {                        
        $val->getProductValidation($request);                
        
        \DB::transaction(function () use ($request, $id) {
            $receipt = \ListIt\Receipt::findOrFail($id);                                

            $product = \ListIt\Product::firstOrCreate(['Name'=>$request->input('name')]);

            $receipt_product = \ListIt\Receipt_Product::firstOrCreate(['ReceiptID'=>$receipt->ID, 'ProductID'=>$product->ID, 'TotalPrice'=>$request->input('totalPrice'), 'Quantity'=>$request->input('quantity')]);
            /*$receipt_product->receiptID = $receipt->ID;
            $receipt_product->productID = $product->ID;
            $receipt_product->TotalPrice = $request->input('totalPrice');
            $receipt_product->Quantity = $request->input('quantity');
            $receipt_product->save();*/
        });
        
        return redirect('/receipt/'. $id);
    }
    
    public function update(ValidationService $val, Request $request, $id, $receiptproductid) {
        $val->getProductValidation($request);
        
        \DB::transaction(function () use ($request, $id, $receiptproductid) {                        
            
        });
    }
}
