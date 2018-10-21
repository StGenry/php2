<?php
namespace app\models;

class Comment extends Model
{
    public $id;
    public $name;
    public $text;
    
    public function getTableName(){
        return 'comments';
    }

    public function getClassName() {
        return __CLASS__;
    }

}