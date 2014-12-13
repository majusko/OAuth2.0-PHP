<?php

/**
 * Class User
 * is domain level class which is needed for authorization process.
 */
class User {

    private $id;
    private $login;

    function __construct($id, $login) {
        $this->id = $id;
        $this->login = $login;
    }

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
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

} 