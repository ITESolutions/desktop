<?php
/**
 * ITE Framework global functions
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

 /******************************************************************************************/
 /*                                    Error Handling                                      */
 /******************************************************************************************/
 
 if (!defined ('ERROR_FILE')) {
     define ('ERROR_FILE', 'error.log');
 }
 
 if (!defined ('ERROR_VIEW')) {
     define ('ERROR_VIEW', 'message');
 }
 
/**
 * Error handler
 */
function error_handler($code, $string, $file, $line, $context) {
    echo "<h1>Oops!</h1>" . PHP_EOL
    . "<pre>There was an error on line {$line} of {$file}: {$string}" . PHP_EOL
    . var_dump($expression) . $context . "</p>" . PHP_EOL
    . "<h6>Stack Trace:</h6>" . PHP_EOL
    . "<p>" . debug_print_backtrace() . "</p>" . PHP_EOL;
    return TRUE;
}

/**
 * Function to log errors to a log file
 * @access public
 * @param Exception $error The exception thrown or a string with a message to log
 */
function log_error($error) {
    if (is_a ($error, 'Exception')) {
        $msg = 'An Exception was thrown';
    } elseif (is_string($error)) {
        $msg = $error;
    } else {
        $msg = "An error occured: unknown";
    }
    
    error_log ($msg . PHP_EOL, 3, ERROR_FILE);
}

 
/**
 * Function to get the name of the class that called the current method or function
 * @return string Returns a string on success or boolean false on fail
 */
function get_calling_class() {
    $trace = debug_backtrace ();
    if (isset ($trace[2])) {
        $class = $trace[2]['class'];
        if (stristr($class, '\\')) {
            $array = explode ('\\', $class);
            return end ($array);
        }
        return $class;
    }
    return FALSE;
}

 /******************************************************************************************/
 /*                                          Misc                                          */
 /******************************************************************************************/

/**
 * Function to get the calling method or function
 * @access public
 * @return array_assoc Returns an associative array with the class as the key and the method or function as the value or false on failure
 */
function get_calling_method() {
    $trace = debug_backtrace ();
    if (isset($trace [1])) {
        return array(
            $trace[1]['class'] => $trace[1]['function']
        );
    }
    return FALSE;
}

 /******************************************************************************************/
 /*                                        Autoloader                                      */
 /******************************************************************************************/

/**
 * Autoloader function using namespaces
 * 
 * @access public 
 * @param string $class_name The class name and path to the class set with namespaces
 */
function autoload($class_name) {
    $file = str_replace('\\', DS, $class_name);
    require_once $file . '.php';
}

/**
 * Function to safely rewrite a file after securing a file resource lock.
 * 
 * @param string $file Name of file to write
 * @param string $data data to be written to the file
 * @return boolean True on success, false on fail.
 */
function file_rewrite($file, $data) {
    $fp = fopen ($file, 'w');
    if (!$fp) {
        trigger_error ('Unable to get file handle: ' . $file . '. Check folder permissions.');
    }
    
    // Give the system time to get a lock on error file
    $start = microtime ();
    do {
        $canWrite = flock ($fp, LOCK_EX);
        if (!$canWrite) {
            usleep(100);
        }
    }
    while ((!$canWrite) && ((microtime() - $start) < 1000));
    if (!$canWrite) {
        return FALSE;
    }
    
    fwrite($fp, $data);
    flock($fp, LOCK_UN);
    fclose($fp);
    return TRUE;
}

/**
 * Check if an array is associative
 * If there is at least one string key, $array will be regarded as associative array
 * @param array $array Array to be checked
 * @return bool True if the array is associative
 */
function is_assoc($array) {
    if (!is_array($array)) { return FALSE; }
    return (bool) count(array_filter(array_keys($array), 'is_string'));
}

/**
 * Checks if an array is indexed
 * @param array $array The array to be checked
 * @return boolean
 */
function is_indexed($array) {
    if (!is_array($array)) { return FALSE; }
    return (bool) array_values($array) === $array;
}


function limit_words($words, $limit, $append = ' &hellip;') {
       // Add 1 to the specified limit becuase arrays start at 0
       $limit = $limit+1;
       // Store each individual word as an array element
       // Up to the limit
       $words = explode(' ', $words, $limit);
       // Shorten the array by 1 because that final element will be the sum of all the words after the limit
       array_pop($words);
       // Implode the array for output, and append an ellipse
       $words = implode(' ', $words) . $append;
       // Return the result
       return $words;
}

function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   return $phrase;
}

function zipWithinRange($local, $compare) {
    $range = '/^' . substr($local, 0, 3) . '[0-9]{2}$/';
    if(preg_match($range, $compare)) {
        return true;
    }
    return false;
}

function getZeroPaddedNumber($value, $padding) {
       return str_pad($value, $padding, "0", STR_PAD_LEFT);
}