<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ListIt\Services;

/**
 * Description of LumenFixSessionManager
 *
 * @author UttingeR
 */
class LumenFixSessionManager extends \Illuminate\Session\SessionManager {
    public function __construct(\Laravel\Lumen\Application $app) {
        parent::__construct($app);
    }
}