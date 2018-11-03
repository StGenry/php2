<?php
namespace app\models;

use app\models\repositories\ProductRepository;
use app\services\Session;
use app\models\repositories\CartRepository;

class Cart extends DataEntity
{
    public $id;
    public $userID;
    public $productID;
    public $qty;
    public $price;
    
    public function getBasket()
    {
        $data = [];
        $basket = $this->getData();
        if (!empty($basket)) {
            $productsIds = array_keys($basket);
            $products = (new ProductRepository())->getProductsByIds($productsIds);
            foreach ($products as $product) {
                $data[] = [
                    'product' => $product,
                    'count' => $basket[$product->id]
                ];
            }
        }
        return $data;
    }

    public function getCart($userID) {
        $productList = [];
        $cartTotal = 0;
        $cartData = (new CartRepository())->getCartByUserId($userID);
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
        
        return ["productList" => $productList, "total" => $cartTotal];
    }

    public function add($productId, $qty)
    {
        $basket = $this->getData();
        if(isset($basket[$productId])){
            $basket[$productId] += (int) $qty;
        }else{
            $basket[$productId] = (int) $qty;
        }
        (new Session)->set('basket', $basket);
    }

    private function getData(){
        return (new Session)->get('basket');
    }

}