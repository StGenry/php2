<?php

namespace app\models\repositories;

use app\models\Comment;

class CommentRepository extends Repository
{
    public function getTableName() {
        return 'comments';
    }

    public function getEntityClass() {
        return Comment::class;
    }
}