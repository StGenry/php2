<?php

namespace app\models\repositories;

use app\models\Category;

class CategoryRepository extends Repository
{
    public function getTableName() {
        return 'сategories';
    }

    public function getEntityClass() {
        return Category::class;
    }
}