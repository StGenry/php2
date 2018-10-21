<?php


namespace app\controllers;


use app\models as MD;

class CommentController extends Controller
{
    public function actionComments()
    {
        $model = (new MD\Product())->getAll();
        echo $this->render("cart", ['model' => $model]);
    }
    
}