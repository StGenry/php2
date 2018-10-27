<?php


namespace app\models\repositories;


use app\models\DataEntity;
use app\services\Db;

abstract class Repository implements IRepository
{
    private $db;

    public function __construct() {
        $this->db = static::getDb();
    }

    private static function getDb() {
        return Db::getInstance();
    }

    public function getOne($id) {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return static::getDb()->queryObject($sql, [':id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        return static::getDb()->queryAll($sql, $this->getEntityClass());
    }

    public function getColumnNames() {
        // if (!is_null($this->$tableColumnNames)) { // TODO: здесь оптимизация не получилась, додумать если останется время
        //     return $this->$tableColumnNames;
        // }

        // $this->$tableColumnNames = $this->db->getColumnNames($this->getTableName());
        // return $this->$tableColumnNames;
        return $this->db->getColumnNames($this->getTableName());
    }

    public function delete() {
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $this->db->execute($sql, [':id' => $this->id]);
    }

    public function insert() {
        $columns = [];
        $params = [];
        
        foreach ($this->getColumnNames() as $key => $attr) {
            $params[":{$attr}"] = $this->{$attr};
            $columns[] = "`{$attr}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        $sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function update() {
        $columns = [];
        $params = [':id' => $this->id];
        
        foreach ($this->getColumnNames() as $key => $attr) {
            if (is_null($this->{$attr})) { // чтобы реквизиты не перезатирались, если не были заполнены
                continue;
            }
            $params[":{$attr}"] = $this->{$attr};
            $columns[] = "{$attr} = :{$attr}";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        $sql = "UPDATE `{$table}` SET {$columns} WHERE id = :id";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function save() {
        if ($this->getOne($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

}