<?php


namespace app\controllers;


use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\renderers\IRenderer;

class ProductController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        echo $this->render("catalog", ['products' => $products]);
    }

    public function actionCard()
    {
        $this->useLayout = false;
        $id = (new Request())->get('id');
        
        $product = (new ProductRepository())->getOne($id);
        echo $this->render("card", ['product' => $product]);
    }
}