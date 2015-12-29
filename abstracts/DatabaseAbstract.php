<?php

/**
 * Database Class
 * @author Corey Ray <coreyaray@gmail.com>
 */

namespace Framework\Abstracts;
use Framework\Interfaces;
use Framework\Helpers;

abstract class DatabaseAbstract implements Interfaces\iDatabase
{
    final function __construct($host, $user, $pass, $db) {
        
        $this->connect($host, $user, $pass, $db);
    }

    protected function buildSQLQuery($params) {
        if (!count($params) || !isset($params['action'])) return false;
        switch ($params['action']) {
            case 'select':
                $sql = 'SELECT ' . (isset($params['columns'])) ? \implode(', ', $params['columns']): '*';
        }
        if (isset($params['where'])) { $sql .= ' WHERE ' . $params['where']; }
        if (isset($params['limit'])) { $sql .= ' LIMIT ' . $params['limit']; }
    }
}
