<?php

/**
 * Description of ErrorController
 *
 * @author Corey Ray <coreyaray@gmail.com>
 */

namespace controllers;

class ErrorController extends \abstracts\Controller
{
    public function defaultAction() {
        ;
    }
    
    public function NotFoundAction() {
        include _ROOT. DS.'error'.DS.'404.php';
    }
}
