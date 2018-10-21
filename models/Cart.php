<?php
namespace app\models;

class Cart extends Model
{
    public $id;
    public $userID;
    public $productID;
    public $qty;
    public $price;
    
    public function getTableName(){
        return 'cart';
    }

    public function getClassName() {
        return __CLASS__;
    }

    // public function addProductToCart($productID, $qty) {

    // }
    
    // public function delProductFromCart($goodID, $qty) {

    // }
    
}