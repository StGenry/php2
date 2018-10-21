<?php
namespace app\models\products;

class DigitalProduct extends Product
{
    public function getTableName(){
        return 'products';
    }

    public function add(string $name, string $description, string $producerId){
        
    }

    public function getCost($id, $qty){
        // qty в штуках
    }
}