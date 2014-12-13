<?php


/**
 * Class UserService
 * is service layer class for User related logic.
 */
class UserService {

    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup(){throw new Exception("Serialized singleton!");}

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
     * Strict validation of important User class.
     * @param $device
     * @throws RestException
     */
    public function validateStrictUserType($device){

        if(!$device instanceof User){
            throw new RestException("We need strict User type for proper work in OAuth2.0 PHP lib.",ErrorCode::INTERNAL_ERROR);
        }

    }

} 