<?php


namespace app\controllers;


use app\models\repositories\UserRepository;
use app\services\Request;
use app\models\User;
use app\services\renderers\IRenderer;
use app\services\Session;

class UserController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionIndex()
    {
        echo 'register';
    }

    public function actionRegister()
    {
        $this->useLayout = false;

        // TODO:доделать регистрацию
        echo $this->render("register", ['message' => ""]);
    }

    public function actionLogin()
    {
        $this->useLayout = false;

        $login = (new User)->login();
        if ($login["result"]) {
            echo $this->render("cabinet", ['user' => $login["user"]]);
        } else {
            echo $this->render("login", ['message' => $login["data"]]);
        }
    }

    public function actionCabinet()
    {
        // TODO: если не залогинен перекинуть на страницу логина (проверить)
        
        $session = new Session();
        $userID = $session->get('user_id');
        $userLogin = $session->get('user_login');
        $userName = $session->get('user_name');
        if(!$user_id = $session->get('user_id')){
             echo $this->render("login", ['message' => ""]);
        }
                
        echo $this->render("Cabinet", ['name' => $session->get('user_login'), 'login' => $session->get('user_name')]);

    }

}