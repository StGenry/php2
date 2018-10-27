<?php
namespace app\models;

class Order extends DataEntity
{
    public $id;
    public $address;
    public $tel;
    public $recipientName;
    public $paymentMethod;
    public $deliveryMethod;
    public $sum;
    public $state;
    public $products;

    public function __construct()
    {
        $this->MyNewProperty = NULL;
    }

}