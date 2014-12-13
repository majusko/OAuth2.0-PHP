<?php


interface UserDaoInt {

    public function getUserForAuthByLoginAndPassword($login, $password);

} 