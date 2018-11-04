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
        echo $this->render("login", ['message' => ""]);
    }

    /**
     * Авторизация
     *
     * @return void
     */
    public function actionLogin()
    {
        $this->useLayout = false;
        $request = new Request();
        if($request->isPost()) {
            $login = (new User)->login($request->post('login'), $request->post('password'));
            if ($login["result"]) {
                echo $this->render("cabinet", ['user' => $login["data"]]);
            } else {
                echo $this->render("login", ['message' => $login["data"]]);
            }
            exit;
        }
        echo $this->render("login", ['message' => ""]);
    }

    public function actionCabinet()
    {
        // TODO: если не залогинен перекинуть на страницу логина (проверить)
        
        $session = new Session();
        $userLogin = $session->get('user_login');
        $userName = $session->get('user_name');
        if(!$user_id = $session->get('user_id')){
             echo $this->render("login", ['message' => ""]);
        }
                
        echo $this->render("Cabinet", ['name' => $userName, 'login' => $userLogin]);

    }

    public function actionRegister()
    {
        $this->useLayout = false;

        // TODO:доделать регистрацию
        echo $this->render("register", ['message' => ""]);
    }
}