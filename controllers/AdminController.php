<?php
/**
 * Administration Controller
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace controllers;

class AdminController extends \abstracts\Controller
{
    public function defaultAction() {
        ;
    }
    
    public function settingsAction() {
        echo '<h1>Settings</h1>>hr>';
        include _ROOT.DS.'html'.DS.'settings.php';
    }
}
