<?php

namespace Framework\Cura\Views;
use Framework\Cura\helpers as helpers;

class View
{
    private
            $_component,
            $_template,
            $_document;


    public function __construct() {
        $this->_template = 'default';
    }
    
    private static function getComonentFile() {
        return str_replace('\\', DS, __NAMESPACE__)
                . DS . helpers\Router::getControllerName()
                . DS . helpers\Router::getActionName() . '.php';
    }
    
    private static function getComponent() {
        
        $file = self::getComonentFile();
        ob_start();
        include $file;
        return ob_get_clean();
    }
    
    public function render($type = 'default') {
        include APP_ROOT . DS . 'Framework' . DS . 'Cura' . DS . 'Templates' . DS . $this->_template . DS . $type . '.php';
    }

    public function __destruct() {
        $this->render();
    }
    
    
}
