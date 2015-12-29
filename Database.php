<?php

defined ('_ITE') or die;

/**
 * Database handler
 * **uses PDO only at the current version
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */


class Database {
    /** @var PDO Database connection handle **/
    private static $_connection = false;
    
    private $_host = '127.0.0.1', $_user = 'root', $_password, $_database="cura_desktop";


    public static function getConnection() {
        if (!self::$_connection) {
            new self();
        }
        return self::$_connection;
    }

    private function __construct() {
        try {
            
            self::$_connection = new PDO("mysql:host={$this->_host};dbname={$this->_database}",
                    $this->_user, $this->_password);
            if (defined("DEVELOPMENT_MODE")) {
                self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
        } catch (PDOException $e) {
            var_dump($e);
            die();
        }
        
    }
    
    private function __clone() {
        ;
    }

    /**
     * Function to retrieve data from tge database
     * @param string $table The name of the database table to use
     * @param array $params An associative array containing key/value pairs. 
     * @example get('users', array ('where', 'id='.$id ))
     */
    public static function get ($table, $params) {
        $sql = "select * from {$table}";
        
        // Where clause
        if (array_key_exists ('where', $params)) {
            $sql .= " where " . $params['where'];
        }
        
        // Limit clause
        if (array_key_exists ('limit', $params)) {
            $sql .= " limit " . $params['limit'];
        }
        
        self::$_connection->prepare($sql);
    }
    
    /**
     * 
     * @param string $table The name of the database table to use
     * @param array $data
     */
    public static function insert ($table, $data) {
        
    }
    
    /**
     * Function to delete a record by id
     * @param string $table The database table to wr
     * @param int $id The atabase table id
     */
    public static function delete ($table, $id) {
        $stmt = 
                
        $stmt->bindparam(":id",$id);
        return $stmt->execute();
    }
    
    /**
     * 
     * @param type $table
     * @param type $id
     * @param type $data
     */
    public static function update ($table, $id, $data) {
//        try {
//           $stmt = self::$_connection->
//                   $this->db->prepare("UPDATE {$table} SET ");
//   $stmt->bindparam(":fname", $fname);
//   $stmt->bindparam(":lname", $lname);
//   $stmt->bindparam(":email", $email);
//   $stmt->bindparam(":contact", $contact);
//   $stmt->bindparam(":id",$id);
//   $stmt->execute();
//   
//   return true; 
//    } catch (Exception $e) {
//        
//    }
    }


    private function __destruct() {
        if (self::$_connection->inTransaction()) {
            self::$_connection->commit();
        }
    }
}
