<?php

/**
 * Class UserDaoImpl
 * implements required user persistent layer for our oauth library.
 */
class UserDaoImpl implements UserDaoInt {

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

    public function getUserForAuthByLoginAndPassword($login, $password) {
        // TODO: Implement getUserForAuthByLoginAndPassword() method.
        return new User(1,"test@test.test");
    }
}
