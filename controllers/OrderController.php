<?php


namespace app\controllers;


use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\renderers\IRenderer;

class OrderController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionIndex()
    {
        $orders = (new OrderRepository())->getAll();
        echo $this->render("orderlist", ['orders' => $orders]);
    }

    public function actionOrder()
    {
        $this->useLayout = false;
        $id = App::call()->request->get('id'); // TODO: доработать класс работы с БД на выборку с фильтром (чтобы отбирать по userID)
        
        $order = (new OrderRepository())->getOne($id);
        echo $this->render("order", ['order' => $order]);
    }
}