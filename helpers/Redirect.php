<?php

namespace Framework\Cura\helpers;

class Redirect
{
    public static function to($location = '')
    {
        if ($location) {
            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        require 'includes' . DS . 'errors' . DS . '404.php';
                        exit();
                        break;
                }
            } else {
                header('Location: ' . $location);
                exit();
            }
        }
    }
}