<?php
/**
 * ITE Framework 1.1 Bootstrap
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

// check for invalid runtime
require_once 'system_check.php';

define('_ROOT', dirname(__FILE__));
define('DEVELOPMENT_MODE', 1);

/**
 * @todo Check for unwanted behavior.
 */
if (filter_input(INPUT_POST, 'dev') || defined('DEVELOPMENT_MODE')) {
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}
// Include core functions
require_once 'Database.php';
require_once 'functions.php';
set_error_handler('error_handler');
spl_autoload_extensions('.php');
spl_autoload_register('autoload');



// start router
new Router();


