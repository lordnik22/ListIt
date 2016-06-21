<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'driver' => 'file',
    'lottery' => [1, 10],
    'expire_on_close' => true,
    'path' => '/',
    'domain' => env('DOMAIN', 'localhost'),
    'cookie' => 'SESS',
    'lifetime' => 15,
    'files' => storage_path('framework/sessions')
];

?>