<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Services;

class ConversionService {
    public function getArrayReceipt($receipt) {                
        return [
            'ID' => $receipt->ID,
            'Datum' => $this->getProperyOfNullObject($receipt, 'Datum'),
            'Receipt_Products' => $receipt->receipt_products->map([$this, 'getArrayReceiptProduct']),
            'Company' => $this->getArrayCompany($receipt->company_shoplocation->company),
            'ShopLocation' => $this->getArrayShopLocation($receipt->company_shoplocation->shoplocation),
            'TotalPrice' => $receipt->receipt_products->sum('TotalPrice')            
        ];
    }

    public function getArrayReceiptProduct($receipt_product) {
        return [
            'ID' => $receipt_product->ID,
            'Quantity' => $receipt_product->Quantity,
            'TotalPrice' => $receipt_product->TotalPrice,
            'Product' => $receipt_product->product
        ]; 
    }

    public function getArrayCompany($company) {
        return [
            'ID' => $this->getProperyOfNullObject($company, 'ID'),
            'Name' => $this->getProperyOfNullObject($company, 'Name')
        ];
    }

    public function getArrayShopLocation($shoplocation) {
        $country = $this->getProperyOfNullObject($shoplocation->region, 'country');
        return [
            'ID' => $shoplocation->ID,
            'StreetNr' => $shoplocation->StreetNr,                        
            'Street' => $this->getProperyOfNullObject($shoplocation->street, 'Name'),
            'Region' => $this->getProperyOfNullObject($shoplocation->region, 'Name'),
            'Country' => $this->getProperyOfNullObject($country, 'Name')
        ];
    }
    
    private function getProperyOfNullObject($obj, $property) {                
        return $obj === null ? null : $obj->$property;
    }

    public function getArrayWeekOverview($receipts) {                
        $receiptDays = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0,
        ];                                
        
        foreach($receiptDays as $day => &$average)
        {
            $receiptsOfTheDay = $receipts->filter(function($receipt) use ($day) {
                return date('l', strtotime($receipt["Datum"])) === $day;
            });
            
            if($receiptsOfTheDay->count() != 0) {
                $average = $receiptsOfTheDay->map(function($receipt) {
                                return $receipt->receipt_products;
                            })
                            ->flatten()
                            ->sum('TotalPrice') / $receiptsOfTheDay->count();
            }
        }
        return $receiptDays;
    }
}
