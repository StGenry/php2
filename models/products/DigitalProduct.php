<?php
namespace app\models\products;
use app\models as ML;

class DigitalProduct extends ML\Product
{
    public $link;
    
    public function getTableName(){
        return 'products';
    }

    public function add(string $name, string $description, string $producerId, string $link){
        
    }

    public function getCost($id, $qty){
        // qty в лицензиях
        var_dump('DigitalProduct.getCost()');
    }
}