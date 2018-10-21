<?php
namespace app\models;

class Category extends Model
{
    public $id;
    public $name;
    public $description;
    public $parent;
    
    public function getTableName()
    {
        return 'сategory';
    }

    public function getClassName() {
        return __CLASS__;
    }

}