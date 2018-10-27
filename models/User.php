<?php
namespace models;

class User extends DataEntity
{
    public $id;
    public $login;
    public $password;
    public $name;
    public $lastName;
   

    public function getFullName() {
        return $this->name . " " . $this->lastName;
    }
}