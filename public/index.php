<?php

/**
 * Cura Remixed
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @internal 
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

/** @see author_documentation.txt **/
define('START_TIME', time());

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

/** @internal This is a constant used to verify that all requests are routed
 * through the application in the correct order to assure security and stability
 */
define('_ITE', 1);
define ('_PUBLIC', realpath ('.'));

/**_____________________________________________________________________________ 
 * BEGIN DEBUGGING SECTION______________________________________________________
 * This area is set aside for testing system capabilties prior to loading any
 * additional functionality
 **/

/** @todo DO NOT LEAVE THIS SECTION UNCHECKED!!! **/

$var1 = 'Config.php';
require_once $var1;

/**_____________________________________________________________________________ 
 * END DEBUGGING SECTION________________________________________________________
 */

include '../bootstrap.php';