<?php

/**
 * Class TodoService
 * is example class of service layer
 */
class TodoService {

    private static $instances = array();
    protected function __construct() {}
    protected function __clone() {}
    public function __wakeup(){throw new Exception("Serialized singleton!");}

    public static function getInstance()
    {
        $classes = get_called_class();
        if (!isset(self::$instances[$classes])) {
            self::$instances[$classes] = new static;
        }

        return self::$instances[$classes];

    }

    public function addTodo(Todo $todo){
        echo "add Todo";
    }

    public function editTodo(Todo $todo){
        echo "edit Todo";
    }

    public function deleteTodo($todoId){
        echo "delete Todo";
    }

    public function getTodo($todoId){
        echo "get Todo";
    }

} 