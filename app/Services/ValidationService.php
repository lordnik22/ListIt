<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Services;
use Illuminate\Http\Request;
use Validator;

class ValidationService {       
    
    /*public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new ValidationException($validator, new JsonResponse($validator->errors()->getMessages(), 422));
        }
    }*/
    
    public function getReceiptValidation(Request $request, $parent) {                
        $parent->validate($request, [
            'country' => 'string',
            'streetNr' => 'numeric',
            'datum' => 'date'
        ]);
    }
    
    public function getProductValidation(Request $request, $parent) {
        $parent->validate($request, [
            'name' => 'required',
            'totalPrice' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1'            
        ]);
    }
}
