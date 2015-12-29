<?php

/**
 * IndexController - this is the default controller for landing,
 *  error reporting, authentication, etc.
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
 
namespace controllers;

defined ('_ITE') or die;

class index extends \abstracts\Controller {
    
    
    public function __construct() {
        echo 'index controller';
    }
    
    public function defaultAction() {
        echo 'default action';
    }
    
    public function login() {
        echo "login";
    }
    
    public function register() {
        echo "register";
    }
}