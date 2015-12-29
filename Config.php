<?php

class Config
{
    private static $_settings = array();
    
    private function populate() {
        self::$_settings = parse_ini_file('settings.ini');
    }
    
    public function getSettings() {
        if (empty(self::$_settings)) {
            $this->populate();
        }
    }
    
    private static function _loadSettings($force_read = false) {
        if (!self::$_settings || $force_read) {
            new Config();
        }
        return self::$_settings;
    }

    public static function get($path)
    {
        $pathArray = explode('_', $path);
        $config = self::getSettings();
        
        if (!count($pathArray) === 2) {
            return '';
        }
        $section = $pathArray[0];
        $key = $pathArray[1];
        return $config[$section][$key];
    }
}
?>