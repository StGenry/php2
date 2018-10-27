<?php
namespace app\models;

class Cart extends DataEntity
{
    public $id;
    public $userID;
    public $productID;
    public $qty;
    public $price;
    
}