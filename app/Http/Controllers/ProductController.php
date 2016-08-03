<?php

namespace ListIt\Http\Controllers;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use ListIt\Services\ValidationService;
use ListIt\Services\ConversionService;

class ProductController extends Controller {
    
        
    public function create(ValidationService $val, Request $request, $id) {
        try{
            $val->getProductValidation($request, $this);
        } catch (\Illuminate\Validation\ValidationException $ex) {
           
            $errorMessages = $ex->getResponse()->getData();
            $receipt_product = new \ListIt\Receipt_Product;
            //TO DO: Sticky Form on the View with $receipt_product
            return view('createproduct', ['ID' => $id, 'receipt_product' => $receipt_product,'errorMessages' => $errorMessages]);
        }
        
        \DB::transaction(function () use ($request, $id) {
            $receipt = \ListIt\Receipt::findOrFail($id);

            $product = \ListIt\Product::firstOrCreate(['Name' => $request->input('name')]);

            $receipt_product = \ListIt\Receipt_Product::firstOrCreate(['ReceiptID' => $receipt->ID, 'ProductID' => $product->ID, 'TotalPrice' => $request->input('totalPrice'), 'Quantity' => $request->input('quantity')]);
        });

        return redirect('/receipt/' . $id);
    }

    public function showProductForm(ConversionService $conv, $id, $receiptproductid) {
        $receipt_product = \ListIt\Receipt_Product::with('product')->findOrFail($receiptproductid);
        return view('createproduct', ['ID' => $id, 'receipt_product' => $conv->getArrayReceiptProduct($receipt_product)]);
    }

    public function update(ValidationService $val, Request $request, $id, $receiptproductid) {
        $val->getProductValidation($request, $this);

        \DB::transaction(function () use ($request, $receiptproductid) {
            $product = \ListIt\Product::firstOrCreate(['Name' => $request->input('name')]);

            $receipt_product = \ListIt\Receipt_Product::where('ID', $receiptproductid)->firstOrFail();
            $receipt_product->productID = $product->ID;
            $receipt_product->TotalPrice = $request->input('totalPrice');
            $receipt_product->Quantity = $request->input('quantity');
            $receipt_product->save();
        });

        return redirect('/receipt/' . $id);
    }

    public function getStatistic(ConversionService $conv) {
        
    }

}
