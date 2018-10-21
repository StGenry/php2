<?php
namespace app\models\products;

class WeightProduct extends Product
{
    public function getTableName(){
        return 'products';
    }

    public function add(string $name, string $description, string $producerId, string $link){
        
    }

    public function getCost($id, $qty){
        // qty в граммах
    }
}