<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ListIt\Services\ValidationService', function ($app) {
            return new \ListIt\Services\ValidationService;
        });
        
        //$this->app['conv'] = new \ListIt\Services\ConversionService;
    }
}