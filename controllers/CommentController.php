<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\renderers\IRenderer;

class CommentController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionComments()
    {
        $model = (new ProductRepository())->getAll();
        echo $this->render("comment", ['model' => $model]);
    }
}