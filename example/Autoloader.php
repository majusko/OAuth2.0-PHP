<?php
/**
 * Created by PhpStorm.
 * User: eglu
 * Date: 12/12/14
 * Time: 00:52
 */

class Autoloader {

    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup(){throw new Exception("Cannot unserialize singleton");}

    public static function init()
    {
        $classes = get_called_class();
        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        return self::$instances[$classes];

    }

    function __autoload($class_name)
    {
        $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';

        $file = AP_SITE.$filename;

        if ( ! file_exists($file))
        {
            return FALSE;
        }
        include $file;
    }

} 