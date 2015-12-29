<?php

/**
 * Description of Registry
 *
 * @author Corey Ray
 */
define('REGISTRY_LOAD_START', true);

class Registry
{
    private static $_data = array();
    
    private static function set($key, $data) {
        self::$_data[$key] = $data;
    }
    
    private static function get($key) {
        return self::$_data[$key];
    }
    
    public static function register() {
        
    }
    
    public function __call($name, $arguments) {
        if (empty($arguments)) {
            return $this->get($name);
        }
        $this->set($name, $arguments[0]);
    }
}

$r = new Registry();
$r->test('7654145215');
echo $r->test();

echo '';

define('REGISTRY_LOAD_COMPLETE', true);