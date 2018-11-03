<?php

namespace app\models\repositories;

use app\models\Product;
use app\services\Db as Db;


class ProductRepository extends Repository
{
    public static $tableColumns = [];

    public function getTableName() {
        return 'products';
    }

    // public function getTableColumns() {
    //     if (!is_null($this::$tableColumns)) {
    //         return $this::$tableColumns;
    //     }

    //     $this::$tableColumns = $this->db->getColumnNames($this->getTableName());
    //     return $this::$tableColumns;
    // }

    public function getEntityClass() {
        return Product::class;
    }

    public function getProductsByIds(array $ids){
        $in = implode(", ", $ids);
        return $this->find("SELECT * FROM products WHERE id IN ({$in})", []);
    }

    public function getProductsWithDiscount()
    {

    }
}