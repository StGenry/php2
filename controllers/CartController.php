<?php


namespace app\controllers;


use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\renderers\IRenderer;

class CartController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionIndex()
    {
        echo "emptyCart";
    }

    public function actionCart()
    {
        $this->useLayout = false;
        $id = (new Request())->get('id');

        $productList = [];
        $cartTotal = 0;
        
        $cartData = (new CartRepository())->getAll(); // TODO: реализовать отбор по userID
        foreach ($cartData as $key => $item) {
            $productChars = (new ProductRepository())->getOne($item->productID); // TODO: реализовать нормальный JOIN вместо запроса в цикле
            $total = $item->qty * $productChars->price;
            $productList[] = [
                'id' => $item->id, 
                'name' => $productChars->name, 
                'image_path' => $productChars->image_path, 
                'price' => $productChars->price, 
                'quantity' => $item->qty, 
                'total' => $total
            ];
            
            $cartTotal += $total;
        }        

        echo $this->render("cart", ['productList' => $productList, 'cartTotal' => $cartTotal]);
    }
    
}