<?php

/**
 * Class DeviceService
 * is service layer class for Device related logic.
 */
class DeviceService extends BaseService {

    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup(){
        //Cant throw exception in handler.
    }

    /**
     * @return mixed - Get single instance.
     */
    public static function getInstance(){

        $classes = get_called_class();
        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        return self::$instances[$classes];
    }

    /**
     * Strict validation of important Device class.
     * @param $device
     * @throws RestException
     */
    public function validateStrictDeviceType($device){

        if($device instanceof Device){
            throw new RestException("We need strict Device type for proper work in OAuth2.0 PHP lib.",ErrorCode::INTERNAL_ERROR);
        }

    }

} 