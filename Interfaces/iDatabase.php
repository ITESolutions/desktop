<?php

/**
 * Database Class Interface
 * @author Corey Ray <coreyaray@gmail.com>
 */

namespace Framework\Interfaces;

interface iDatabase {
    function connect($host, $user, $pass, $db);
    function query($sql, $params);
    function get($params);
    function put($values, $params);
    function update($values, $params);
    function delete($params);
    function getCount();
    function getResults();
    function getFirst();
    function getLast();
    function getError();
}
