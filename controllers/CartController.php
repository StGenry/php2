<?php


namespace app\controllers;


use app\models as MD;
use app\models\Cart;

class CartController extends Controller
{
    public function actionIndex()
    {
        echo "emptyCart";
    }

    public function actionCart()
    {
        $id = $_GET['id']; // userID по которому будет осуществляться фильтр товаров в корзине
        $productList = [];
        $cartTotal = 0;
        
        $cartData = (new MD\Cart())->getAll(); // TODO: реализовать отбор по userID
        foreach ($cartData as $key => $item) {
            $productChars = (new MD\Product())->getOne($item->productID); // TODO: реализовать нормальный JOIN вместо запроса в цикле
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