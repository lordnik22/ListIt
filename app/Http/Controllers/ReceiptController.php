<?php

namespace ListIt\Http\Controllers;

use Illuminate\Http\Request;
use ListIt\Http\Controllers\Controller;
use ListIt\Services\ConversionService;
use ListIt\Services\ValidationService;

class ReceiptController extends Controller {
        
    public function create(ValidationService $val, Request $request) {
        $val->getReceiptValidation($request);
        
        $receiptID = \DB::transaction(function () use ($request) {
                        
            $country = new \ListIt\Country();          
            if(!empty($request->input('country'))) {
                $country = \ListIt\Country::firstOrCreate(['Name'=>$request->input('company')]);
            }
                                                
            $region = \ListIt\Region::firstOrCreate(['Name'=>$request->input('region'), 'CountryID'=>$country->ID]);            
            
            $street = new \ListIt\Country();
            if(!empty($request->input('street'))) {
                $street = \ListIt\Street::firstOrCreate(['Name'=>$request->input('street')]);            
            }                
            
            $shoplocation = \ListIt\Shoplocation::firstOrCreate(['StreetNr'=>$request->input('streetNr'), 'StreetID'=>$street->ID, 'RegionID'=>$region->ID]);
            
            $company = new \ListIt\Country();          
            if(!empty($request->input('company'))) {
                $company = \ListIt\Company::firstOrCreate(['Name'=>$request->input('company')]);
            }
            
            $company_shoplocation = \ListIt\Company_Shoplocation::firstOrCreate(['CompanyID'=>$company->ID, 'ShoplocationID'=>$shoplocation->ID]);
                        
            $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
            
            $receipt = new \ListIt\Receipt();
            $date = $request->input('datum');
            empty($date) ? $receipt->Datum = null : $receipt->Datum = $date;
            $receipt->UserID = $user->ID;
            $receipt->CompanyShoplocationID = $company_shoplocation->ID;
            $receipt->save();                        
            
            return $receipt->ID;                        
        });
        
        return redirect('/receipt/'. $receiptID);
    }
    
    public function get(ConversionService $conv, Request $request) {
        
        $sortOption = null;
        if($request->input("sortOption") !== null) {           
            $sortOption = $request->input('sortOption');            
        }
        else {
            $sortOption = 'Datum';
        }
        
        
        $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
        
        $receipts = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')
                ->where('UserID', $user->ID)         
                ->orderBy($sortOption, 'DESC')
                ->get()->map([$conv, 'getArrayReceipt']);
                
        
        return view('receipts', ['receipts' => $receipts]);
    }
    
    private function getOneReceiptViewModel($conv, $id) {
        $receipt = \ListIt\Receipt::with('receipt_products', 'receipt_products.product')->findOrFail($id);
        return ['receipt' => $conv->getArrayReceipt($receipt)];
    }
    
    public function getOne(ConversionService $conv, $id) {        
        return view ('receipt', $this->getOneReceiptViewModel($conv, $id));
    }
    
    public function showReceiptForm(ConversionService $conv, $id) {
        return view ('createreceipt', $this->getOneReceiptViewModel($conv, $id));
    }
    
    public function update(ValidationService $val, Request $request, $id) {
        $val->getReceiptValidation($request);
        
        


        \DB::transaction(function () use ($request, $id) {
            $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
            
            $country = new \ListIt\Country();          
            if(!empty($request->input('country'))) {
                $country = \ListIt\Country::firstOrCreate(['Name'=>$request->input('company')]);
            }

            $region = \ListIt\Region::firstOrCreate(['Name'=>$request->input('region'), 'CountryID'=>$country->ID]);            

            $street = new \ListIt\Country();
            if(!empty($request->input('street'))) {
                $street = \ListIt\Street::firstOrCreate(['Name'=>$request->input('street')]);            
            }                

            $shoplocation = \ListIt\Shoplocation::firstOrCreate(['StreetNr'=>$request->input('streetNr'), 'StreetID'=>$street->ID, 'RegionID'=>$region->ID]);

            $company = new \ListIt\Country();          
            if(!empty($request->input('company'))) {
                $company = \ListIt\Company::firstOrCreate(['Name'=>$request->input('company')]);
            }

            $company_shoplocation = \ListIt\Company_Shoplocation::firstOrCreate(['CompanyID'=>$company->ID, 'ShoplocationID'=>$shoplocation->ID]);
            
            $receipt = \ListIt\Receipt::findOrFail($id);            
            $date = $request->input('datum');
            empty($date) ? $receipt->Datum = null : $receipt->Datum = $date;
            $receipt->UserID = $user->ID;
            $receipt->CompanyShoplocationID = $company_shoplocation->ID;
            $receipt->save();                        
        });
        
        return redirect('/receipt/'. $id);
    }
    
    public function delete($id)  {                               
        \ListIt\Receipt::findOrFail($id)->delete();                             
        
        return redirect('/receipts');
    }
}
