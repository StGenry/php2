<?php
// Иван Николаенко 2018-10-31
$config = include $_SERVER['DOCUMENT_ROOT'] . "/config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

\app\base\App::call()->run($config);

$productRep = new \app\models\repositories\ProductRepository();

$product = new \app\models\Product();
//$product->id = 22;
$product->name = "Булочка";
$product->description = "с корицей";
$product->producerId = 100;
$product->image_path = "bulochka.jpg";
$product->price = 500;
$productRep->save($product);

//(new \app\services\Session())->set("userID", 1);