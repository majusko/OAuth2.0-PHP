<?php

/**
 * Class AuthService
 *
 */
class AuthService {

    private static $deviceDao;
    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup(){throw new Exception("Cannot unserialize singleton");}

    public static function getInstance(DeviceDaoInt $deviceDaoImpl){
        $classes = get_called_class();
        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        self::$deviceDao = $deviceDaoImpl;

        return self::$instances[$classes];
    }

    public function auth(){
        self::$deviceDao->getDeviceByAccessToken("");
    }

}