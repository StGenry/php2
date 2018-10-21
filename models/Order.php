<?php
namespace app\models;

class Order extends Model
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

    public function getTableName() {
        return 'orders';
    }

    public function getClassName() {
        return __CLASS__;
    }
    
    public function getQueryFields()
    {
        return [':name' => $this->name
            , ':address' => $this->address
            , ':tel' => $this->tel
            , ':recipientName' => $this->recipientName
            , ':paymentMethod' => $this->paymentMethod
            , ':deliveryMethod' => $this->deliveryMethod
            , ':sum' => $this->sum
        ];
    }

    public function getDeleteQueryFilter()
    {
        return [':id' => $this->id];
    }


}