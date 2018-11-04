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

    function getUserByLoginPass($login, $password) {
        $foundData = $this->find(
            "SELECT * FROM {$this->getTableName()} 
                WHERE login = :login AND password = :password"
                , [':login' => $login, ':password' => $password]);
        
        return empty($foundData) ? false : $foundData[0];
    }
    
    function userExists($login) {
        return !empty($this->find(
            "SELECT * FROM {$this->getTableName()} 
                WHERE login = :login"
                , [':login' => $login]));
    }
    
}