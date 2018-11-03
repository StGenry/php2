<?php

namespace app\models\repositories;

use app\models\Cart;

class CartRepository extends Repository
{
    public function getTableName() {
        return 'cart';
    }

    public function getEntityClass() {
        return Cart::class;
    }

    public function getCartByUserId($userID){
        return $this->find("SELECT * FROM {$this->getTableName()} WHERE userID = :userID", [':userID' => $userID]);
    }

}