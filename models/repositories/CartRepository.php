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
}