<?php
namespace models;

class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $name;
    

    public function getTableName() {
        return 'users';
    }

    public function getClassName() {
        return __CLASS__;
    }

    public function getQueryFields()
    {
        return [':name' => $this->name
            , ':login' => $this->login
            , ':password' => $this->password
        ];
    }

    public function getDeleteQueryFilter()
    {
        return [':id' => $this->id];
    }

    public function getUpdateQueryFilter()
    {
        return [':id' => $this->id];
    }


}