<?php
/**
 * Controller Abstract. All functions common to many comtrollers
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace abstracts;
use helpers\Session;
use models\User;
defined ('_ITE') or die;

abstract class Controller {
    
    const N_SPACE = '\\Controllers\\';

    protected 
        /** @var Object An object adhering to the ITE Framework iView interface **/
        $_view,
        $_action,
        $_DB,
        $_user,
        $_session;
    
    private
        $_changed = false; 


    public function __construct($action) {
        
        // Get a connectio to the database
        $this->_DB = \Database::getConnection();
        
        // Start the session manager
        $this->_session = new Session();
        
        
        $this->_action = strtolower($action);
        //$this->_user = new User();
    }
    
    public function defaultAction() {
        $this->errorAction("Please create a default action for this controller");
    }
    
    final protected function authenticate ($user, $hash) {
        
    }


    public function errorAction($error) {
        die($error);
    }

    protected function dispatch() {
        $method = $this->_action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            $this->errorAction(404);
        }
    }

    public function __destruct() {
        $this->dispatch();
    }
    
    /**
     * Returns the name of the called controller
     * @return string
     */
    
    public function __toString() {
        return get_called_class();
    }
    
    
    
    
    
    /*
     * Database Functions
     */
    private function initDb() {
        
    }
    
    protected function dbConnection() {
        if (is_null($this->_db)) {
            $this->initDb();
        }
        return $this->_db;
    }
    
    /*
     * Call the view factory and order a view of the specified type. The default type is HTML.
     */
    
    protected function initView($type = 'html') {
        $this->_view = \views\ViewFactory::getView($type);
    }
    
    
    
}