<?php
namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $producerId;
    public $image_path;
    public $price;

    public function getTableName(){
        return 'products';
    }

    public function getClassName() {
        return __CLASS__;
    }

    // public function add(){
        
    // }

    // public function delete(){
        
    // }

    // public function setPrice(float $price){
        
    // }

    // public function getCurrentPrice($id){
        
    // }

    // public function getCurrentRest($id){
        
    // }

    // public function getProductsWithDiscount() {

    // }

    // public function getCost($id, $qty) {

    // }

}