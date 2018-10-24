<?php
// Иван Николаенко 2018-10-22
include $_SERVER['DOCUMENT_ROOT'] . "/config/main.php";
// ! строка ниже теперь не нужна, подгружать будет Composer
//include $_SERVER['DOCUMENT_ROOT'] . "/services/Autoloader.php";
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
//! вместо прописывания в composer.json можно использовать 2 строки кода ниже
//$loader = require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
//$loader->addPsr4('app\\', $_SERVER['DOCUMENT_ROOT']);

use app\models as ML;
use app\services as SV;
use Composer\Autoload as CA;

// ! строка ниже теперь не нужна, подгружать будет Composer
//spl_autoload_register([new SV\Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){

    $controller = new $controllerClass(
        new SV\renderers\TwigRenderer()
        //new SV\renderers\TemplateRenderer()
    );
    $controller->run($actionName);
}

//! Тест работоспособности функций Twig подтянутых Composer-om
$tw = new Twig_Loader_Filesystem();
//var_dump("Тест работоспособности функций Twig подтянутых Composer-om", "<br>", $tw, "<br>");

//! Тест работоспособности шаблонизатора Twig (нормальная реализация в TwigRenderer.php)
// $loader = new Twig_Loader_Filesystem('../views/twig');
// $twig = new Twig_Environment($loader, array(
//     'cache' => '../views/twig/compilation_cache',
// ));

// echo $twig->render('test.twig', ["name" => "NAME", "description" => "DESCRIPTION"]);


// $product = new ML\Product();

// $product->id = 11;
// $product->name = "Молоко";
// $product->description = "Зеленое";
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
