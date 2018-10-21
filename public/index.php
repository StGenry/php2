<?php
// Иван Николаенко 2018-10-20
include $_SERVER['DOCUMENT_ROOT'] . "/config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/services/Autoloader.php";
use app\models as ML;
use app\services as SV;

spl_autoload_register([new SV\Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
    $controller = new $controllerClass;
    $controller->run($actionName);
}

// $product = new ML\Product();

// $product->id = 11;
// $product->name = "Молок";
// $product->description = "Серое";
// $product->producerId = 555;
// $product->save();

// $product = new ML\Product();
// $product->id = 2;
// $product->delete();

// $product = new ML\Product();
// $product->id = 4;
// $product->name = "Сыр";
// $product->description = "Желтый";
// $product->producerId = 333;
// $product->update();
