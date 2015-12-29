<?php

/**
 * Router Class to direct requests
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

use abstracts\Controller;

final class Router {
    private $_uri, $_db, $_route;

    public function __construct($route = false) {
        $this->_uri = filter_input (INPUT_SERVER, 'REQUEST_URI');
        
        $this->_db = Database::getConnection();
        if (!$this->_checkDatabase()) {
            if (!$this->_checkPath()) {
                $this->_route = new Route($this->_uri);

            }
        }
        $this->_dispatch ();   
    }
    
    private function _checkDatabase() {
        $statement = $this->_db->prepare ("select * from links where link = :link");
        $statement->execute (array (
            ':link' => $this->_uri
        ));
        $route = $statement->fetchObject('Route');
        if (!$route) { return FALSE; }
        $this->_route = $route;
        return TRUE;
    }
    
    private function _checkPath() {
        if ($this->_route = $this->getRouteFromURI()) {
            
        }
    }
    
    private function getRouteFromURI() {
        $path = array_values ( // filter out keys
            array_filter ( // filter out empty values
                explode ( // create an array 
                    '/',
                    // First, get just the path part of the url/uri
                    parse_url ($this->_uri, PHP_URL_PATH)
                )
            )
        );
                
        switch (count ($path)) {
            case 0:
                $this->_route = new Route();
                break;
            case 1;
                $this->_route = new Route ($this->_uri, $path[0]);
                break;
            case 2:
                $this->_route = new Route ($this->_uri, $path[1], $path[0]);
                break;
        }
        
//        self::$_controllerName = is_null ($controller) ? 'Index' :
//            str_replace( ' ', '', ucwords( str_replace('-', ' ', $controller )));
//        
//        self::$_action = (is_null($action)) ? 'default' :
//            str_replace(' ', '', ucwords( str_replace('-', ' ', $action )));
//        
//        $namespace = \Framework\Abstracts\ControllerAbstract::getNamespace();
//        self::$_controllerClass = $namespace . "\\" . self::$_controllerName . 'Controller';

    }
    
    public static function redirect($location) {
        header ('Location: ' . $location);
        exit ();
    }

    private function _dispatch() {
        $controller = Controller::N_SPACE . $this->_route->controller;
        new $controller ($this->_route->action);
    }
}

function cleanPath($path, $pathSeperator = PATH_SEPARATOR) {
    foreach (explode ($pathSeperator, $path) as $segment) {
        return str_replace (' ', '', ucwords (str_replace ('-', ' ', $string )));
    }
    
}

class Route {
    
    // PDO doesn't care about priv
    public $path, $action, $controller;
}