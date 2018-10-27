<?php
// Иван Николаенко 2018-10-27
include $_SERVER['DOCUMENT_ROOT'] . "/config/main.php";
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use app\models as ML;
use app\services as SV;
use Composer\Autoload as CA;

$request = new \app\services\Request();

$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){

    $controller = new $controllerClass(
        // new SV\renderers\TwigRenderer()
        new SV\renderers\TemplateRenderer()
    );
    try {
       $controller->run($actionName);
    } catch (\Exception $e) {
        (new ExceptionController(
            new SV\renderers\TemplateRenderer()
            ))->show404();
    } 

}