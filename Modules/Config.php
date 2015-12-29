<?php

/**
 * =============================================================================
 * | Config.php                                                                |
 * =============================================================================
 * Configuration class that offers the option of using an SQL server or the 
 * file system to store data.
 * 
 * Purpose: This class is designed as a stand-alone module for use in 
 * applications where dynamic storage is required when access to an SQL server
 * is not garaunteed. Ideal for applications where a small application needs a
 * way to store configuration data
 * 
 * Developer Notes:
 * This is my first use of multiple class declarations in a single file. I'm 
 * attempting this change in my style to reduce the load on autoloaders.
 * =============================================================================
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @internal This class is for developer/maintenance level users.
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */


/** 
 * @todo Create a library in the library namespace and publish as seperate
 * package
 * @todo Publish to GitHub as stand-alone when finished
 *  
 **/
namespace modules;

/** @uses Database.php **/
use helpers\Database;

/** @uses File.php **/
use helpers\File;

/** @see comment this out if you want to allow direct script access outside
 * of the framework **/
//defined ('_ITE') or die;

/**
 * Config Class - use as a companion to any web application project or a module
 * in the ITE Framework
 */
class Config {
    
    /** @var DatabaseConfig/FsConfig The object representing the current storage
     * schema and media. It is currently available as a static class variable.
     */
    private static $_config = false;

    /**
     * Configuration class that will attempt to use the built-in PDO class
     * to store and retrieve 
     */
    public function __construct() {
        $this->tryDBConnect();
        if (!self::$_config) {
            $this->tryFSConnect();
        }
        else { die; } // ERROR PAGE
    }
    
    /**
     * Function to attempt to load a database table for storing configuration
     * values
     */
    public function tryDBConnect() {
        try {
            new Database();
        } catch (Exception $ex) {
            echo "<h1>There was an error: " . $ex->message . "<h1>";
        }
    }
    
    /**
     * Function to attempt to load a configuration file from the filesystem to
     * store configuration values
     */
    public function tryFSConnect() {
        
    }



    /**
     * Function 
     * @param string $key 
     * @param styring $value
     */
    public function update($key, $value) {
        self::$_config->update($key, $value);
    }
    
    /**
     * Function to get a configuration value
     * @param string $key This is a string value corresponding to the config
     * value to retrieve
     */
    public function get($key) {
        self::$_config->get($key);
    }
}

class DatabaseConfig implements \interfaces\Configuration {
    
    /** @var PDO_Object Reference to the database connection **/
    private $_db;
    
    /** @var string Constant containing the name of the database table to store
     *  the configuration.
     */
    const DB_TABLE = 'config';
    
    /** @var integer The operating system of the server. I am using constants
     * because there is already time sat aside to load those prior to execution,
     * as with client side OS detection, some sort of handshake is required
     * at minimum.
     * 
     * 
     * @todo implement client side os detection as a seperate branch project
     */
    const OS_WIN = 0, OS_LINUX = 1, OS_MAC = 2, OS_OTHER = 0;
    
    public function init() {
        $this->db = Database::getConnection();
    }
    
    public function update($key, $value) {
        $sql = "UPDATE " . self::DB_TABLE . "";
    }
    
    public function get($key) {
        $sql = "SELECT " . $key . " FROM " . self::DB_TABLE;
        
    }
}

class FsConfig implements Configuration {
    const FILE = 'app_data';
    /** @todo encryption **/
    
    public static function init() {
        
    }
    
    public static function update($key, $value) {
        
    }
    
    public static function get($key) {
        
    }
}



interface Configuration { public function update($key, $value); public function get($key); }

/**
 * Autoloader - A generic autoload function that uses namespaces to load classes
 * assuming that the namespace is also the path to the file
 * 
 * @see Checks if class is already loaded in case the defalt behavior changes
 * @param string $class The name of the class that needs to be loaded
 */
function autoload($class) {
    if (!class_exists($class)) {
        $file = str_replace('\\', DS, $class_name);
        require_once $file . '.php';
    }
    
    
}

/**
 *******************************************************************************
 * TESTING AREA                                                                *
 *******************************************************************************
 */



/** @internal ! IMPORTANT ! **/
/** @see security.notes| */
?>