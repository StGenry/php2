<?php
namespace app\models;
use app\services\Request;
use app\services\Session;
use app\models\repositories\UserRepository;

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

    public function registerUser() { // TODO: задать вопрос Игорю не надругательство ли над SOLID-ом подобная реализация
        return (new \app\models\repositories\UserRepository())->save($this);
    }

    public function login($login, $password) {
        $message = '';
        if($user = (new UserRepository)->getUserByLoginPass($login, $password)){
            $session = new Session();
            $session->set('user_id', $user->id);
            $session->set('user_name', $user->name);
            $session->set('user_login', $user->login);
            return ["result" => true, "data" => $user];
        }
        $message = "Неправильный логин/пароль!";
        return ["result" => false, "data" => $message];
    }
}