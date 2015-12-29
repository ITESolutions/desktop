<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

use helpers;

class LoginController extends ControllerAbstract
{
    public function defaultAction() {
        
        if (helpers\Input::exists() && helpers\Token::check(helpers\Input::get('token'))) {
            $valid = helpers\Validation::check(array(
                'username' => array(
                    'required' => true,
                    'name' => 'Username'
                ),
                'password' => array(
                    'required' => true,
                    'name' => 'Password'
                )
            ));
            
            if (empty($valid->errors())) {
                
            } else {
                foreach ($valid->errors() as $error) {
                    
                }
            }
                
        }
        
    }
}
