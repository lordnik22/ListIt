<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Services;

class ConversionService {
    public function getJsonReceipt($receipt) {        
        return [
            'ID' => $receipt->ID,
            'Datum' => $receipt->Datum,
            'Receipt_Products' => $receipt->receipt_products->map([$this, 'getJsonReceiptProduct']),
            'Company' => $this->getJsonCompany($receipt->company_shoplocation->company),
            'ShopLocation' => $this->getJsonShopLocation($receipt->company_shoplocation->shoplocation),
            'TotalPrice' => $receipt->receipt_products->sum('TotalPrice')
        ];
    }

    public function getJsonReceiptProduct($receipt_product) {
        return [
            'Quantity' => $receipt_product->Quantity,
            'TotalPrice' => $receipt_product->TotalPrice,
            'Product' => $receipt_product->product
        ];
    }

    public function getJsonCompany($company) {
        return [
            'ID' => $company->ID,
            'Name' => $company->Name
        ];
    }

    public function getJsonShopLocation($shoplocation) {
        return [
            'ID' => $shoplocation->ID,
            'StreetNr' => $shoplocation->StreetNr,
            'Street' => $shoplocation->street->Name,
            'Region' => $shoplocation->region->Name,
            'Country' => $shoplocation->region->country->Name
        ];
    }

}
