<?php

namespace app\controllers;

use app\services\Exception;
use app\services\renderers\IRenderer;

class ExceptionController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function showError($message)
    {
        echo $this->render("error", ['message' => $message]);
    }

    public function show404()
    {
        echo $this->render("404");
    }

}