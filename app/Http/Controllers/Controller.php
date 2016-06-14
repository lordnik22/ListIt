<?php

namespace ListIt\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use ListIt\Services\ConversionService;

class Controller extends BaseController
{
    private $conv;
    
    public function __construct(ConversionService $conv) {
        $this->conv = $conv;
        
    }
}
