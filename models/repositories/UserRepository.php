<?php

namespace app\models\repositories;

use app\models\User;

class UserRepository extends Repository
{
    public function getTableName() {
        return 'users';
    }

    public function getEntityClass() {
        return User::class;
    }

    function getUserByLoginPass($login, $pass) {
        return $this->find(
            "SELECT * FROM {$this->getTableName()} 
                WHERE login = :login AND password = :password"
                , [':login' => $login, ':password' => $password]);
    }
    
    function userExists($login) {
        return !empty($this->find(
            "SELECT * FROM {$this->getTableName()} 
                WHERE login = :login"
                , [':login' => $login]));
    }
    
}