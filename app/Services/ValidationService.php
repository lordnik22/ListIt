<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Services;

class ValidationService {
    public function getReceiptValidation($request) {                
        $this->validate($request, [
            'country' => 'string',
            'streetNr' => 'numeric',
            'datum' => 'date'
        ]);
    }
    
    public function getProductValidation($request) {
        $this->validate($request, [
            'name' => 'required',
            'totalPrice' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1'            
        ]);
    }
}
