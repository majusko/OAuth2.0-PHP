<?php


/**
 * Class DeviceDaoImpl
 * implements required device persistent layer for our oauth library.
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

    public function getDeviceByAccessToken($accessToken) {
        // TODO: Implement getDeviceByAccessToken() method.
        return new Device("testT", time(), "testIID", "testR", 1);
    }

    public function getDeviceByRefreshToken($refreshToken){
        // TODO: Implement getDeviceByRefreshToken() method.
        return new Device("testT", time(), "testIID", "testR", 1);
    }

    public function getDeviceByUserIdAndInstallationId($refreshToken, $installationId){
        // TODO: Implement getDeviceByUserId() method.
        return new Device("testT", time(), "testIID", "testR", 1);
    }

    public function insert(Device $device) {
        // TODO: Implement insert() method.
        return 1;
    }

    public function update(Device $device) {
        // TODO: Implement ubpdate() method.
    }

    public function delete(Device $device) {
        // TODO: Implement delete() method.
    }

}