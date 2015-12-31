<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Framework\Cura\Controllers;

/**
 * Description of HelpController
 *
 * @author Corey
 */
class HelpController extends ControllerAbstract
{
    public function defaultAction() {
    }
    
    public function FaqAction() {
        $this->view = new \Framework\Cura\Views\View();
    }
        
}
