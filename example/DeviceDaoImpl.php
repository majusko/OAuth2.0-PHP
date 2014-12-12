<?php

require_once("../persistent/DeviceDaoInt.php");

/**
 * Class DeviceDaoImpl
 * Is example of dao layer class.
 */
class DeviceDaoImpl implements DeviceDaoInt {

    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup(){throw new Exception("Serialized singleton!");}

    public static function getInstance() {
        $classes = get_called_class();
        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        return self::$instances[$classes];
    }

    public function getDeviceByAccessToken($accessToken)
    {
        echo 'test';
        // TODO: Implement getDeviceByAccessToken() method.
    }

    public function getDeviceByRefreshToken($refreshToken)
    {
        // TODO: Implement getDeviceByRefreshToken() method.
    }

    public function getDeviceByUserId($refreshToken)
    {
        // TODO: Implement getDeviceByUserId() method.
    }

    public function insert(Device $device)
    {
        // TODO: Implement insert() method.
    }

    public function ubpdate(Device $device)
    {
        // TODO: Implement ubpdate() method.
    }

    public function delete(Device $device)
    {
        // TODO: Implement delete() method.
    }

}