<?php

/**
 * =============================================================================
 * | Configuration.php                                                                |
 * =============================================================================
 * This class serves as a set of rules to describe the method of communication
 * between the Config.php class. Every class used by Config.php must be able to
 * implement this interface.
 * =============================================================================
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @deprecated during development, the choice was made to include this interface
 * within the Config.php file as to further lighten the load on the autoloader
 * @internal This class is for developer/maintenance level users.
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace interfaces;

interface IConfig {
    /**
     * @param string $key is the index to change the value of
     * @param string/function/object $value This can be anything with a toString
     * representation
     */
    public function update($key, $value);
    
    public static function get($key);
}

// ! IMPORTANT ! //
/** @see security.notes| */
?>