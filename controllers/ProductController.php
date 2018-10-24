<?php


namespace app\controllers;


use app\models as MD;
use app\services\renderers as SR;

class ProductController extends Controller
{
    public function __construct(SR\IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionIndex()
    {
        $products = (new MD\Product())->getAll();
        echo $this->render("catalog", ['products' => $products]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = (new MD\Product())->getOne($id);
        echo $this->render("card", ['product' => $product]);
    }
    
}