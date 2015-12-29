<?php

/*
 * Cura Core Functions
 * @author Corey Ray <coreyaray@gmail.com>
 * @version 1.1
 */

namespace Framework\Cura;
use Framework\Cura\helpers as helpers;
use Framework\Cura\Controllers as controllers;
use Framework\Cura\Models as models;

abstract class Cura
{
    private
            $_application = false,
            $_systemMessages = array(),
            $_db = false,
            $_path = array(
                'controller'    => '',
                'action'        => '',
                'id'            => ''
            );
    
    private function __construct() {
        $this->_db = helpers\Database::getInstance();
        ;
    }

    public static function Notify($msg) {
        new helpers\Notification($msg);
    }

    public static function start() {
        if (!$this->_application) {
            $this->_db = new $this;
        }
    }
    
    private function initialize() {
        
    }
    
    /*
     * Loader
     */
    
    
    /*
     * System Configuration
     */
    
    public static function getViewFolder() {
        return realpath(__DIR__) . DS . 'Views';
    }
    
    
    /*
     * Application Configuration
     */
    
    /*
     * Database Configuration
     */


    public static function getDatabaseInstance() {
        if (!self::$_db) {
            self::$_db = helpers\Database::getInstance();
        }
        return self::$_db;
    }
    
    public static function RequestUri() {
        return filter_input(INPUT_SERVER, 'REQUEST_URI');
    }
    
    private static function route() {
        new helpers\Router();
    }
    
    public static function getRegistryObject() {
        if (!self::$_registry) {
            self::$_registry = new Registry();
        }
    }
    
    public static function addIncludeFolder($folder) {
        if (!is_dir($folder)) {
            return false;
        }
        $includePath = get_include_path();
        if (!is_null($includePath)) {
            $paths = explode(PS, $includePath);
            foreach ($paths as $path) {
                if ($path == $folder) return true;
            }
            $folder .= PS;
        }
        return (bool) set_include_path($folder . $includePath);
    }
    
    public static function Redirect($location) {
        if ($location) {
            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        //require 'includes' . DS . 'errors' . DS . '404.php';
                        exit();
                        break;
                }
            } else {
                header('Location: ' . $location);
                exit();
            }
        } else {
            self::Redirect(404);
        }
    }
    
    public static function dumpVar($var) {
        
        if (!defined('DEBUG_WINDOW')) {
            define('DEBUG_WINDOW', 1);
        }
?>
<div style="
     z-index: 9999;
     position: fixed;
     left: 10px;
     bottom: 10px;
     border: 1px solid #BBB;
     width: 300px;
     color: #FFFFFF;
     background-color: #333333;
     background-color: rgba(33,33,33,.3);">
    
    <pre><?php var_dump($var);?></pre>
</div>
    
    <?php

    }
    
    public static function ProcessLogin() {
        if (Input::exists() && Token::check(Input::get('token'))) {
            $valid = Validation::check(array(
                        'username' => array('required' => true, 'name' => 'Username'),
                        'password' => array('required' => true, 'name' => 'Password')
            ));

            if ($valid) {
                $user = $this->_user;
                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                if ($login) {
                    Session::flash('msg', 'You are now logged in');
                    Redirect::to('index.php');
                } else {
                    echo 'Login failed';
                }
            } else {
                echo '<p style="color: #FF0000;">';
                foreach ($valid->errors() as $error) {
                    echo $error, '<br />';
                }
                echo '</p>';
            }
        } else {
            return false;
        }
    }
    
    public static function RegisterUser() {
        
    }
    
    public static function copyright($year = 'auto') {
        if(intval($year) == 'auto'){ $year = date('Y'); }
        if(intval($year) == date('Y')){ echo intval($year); }
        if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); }
        if(intval($year) > date('Y')){ echo date('Y'); }
    }
    
    public static function openZip($zipFileName) {
        $zip = zip_open($zipFileName);
        if (is_resource($zip)) {
            while ($zip_entry = zip_read($zip)) {
            $fp = fopen("zip/".zip_entry_name($zip_entry), "w");
            if (zip_entry_open($zip, $zip_entry, "r")) {
                $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                fwrite($fp,"$buf");
                zip_entry_close($zip_entry);
                fclose($fp);
            }
        }
        zip_close($zip);
    }
  }
}       