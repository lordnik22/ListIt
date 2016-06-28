<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Http\Controllers;
use ListIt\Services\ConversionService;

class HomeController extends Controller {
    
    public function index() {
        return view('index', ['name' => 'alpha', 'password' => 'beta']);
    }
}