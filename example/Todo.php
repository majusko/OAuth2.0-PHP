<?php

/**
 * Class Todo
 * Is example of domain level class
 */
class Todo {

    private $id;
    private $task;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

} 