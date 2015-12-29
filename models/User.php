<?php

namespace models;

class User extends \abstracts\DatabaseModel
{
    const DB_TABLE = 'users';

    protected
            $name,
            $email,
            $joined,
            $password,
            $salt;
    
    
    
    public function set() {
        
        return $this;
    }
    
    
    public static function getById($id = 0) {
        $a = \Database::getConnection()->query ("SELECT * FROM users WHERE `id` = {$id}");
        var_dump($a);
    }
}