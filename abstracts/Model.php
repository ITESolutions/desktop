<?php

/**
 * Abstract for Data Model Classes
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

defined ('_ITE') or die;


namespace abstracts;
use Database;

abstract class Model {
    
    protected $_db;
    
    public function __construct() {
        $this->_db = Database::getConnection();
    }

    public static function getById ($id) {
    
    }
}
