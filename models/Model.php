<?php
namespace app\models;

use app\services\Db;

abstract class Model implements IModel
{
    private $db;
    // public $tableColumnNames = null;

    public function __construct() {
        $this->db = Db::getInstance();
    }

    public function getOne($id) {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return $this->db->queryObject($sql, [':id' => $id], get_called_class());
    }

    public function getAll() {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        return $this->db->queryAll($sql, $this->getClassName());
    }

    public function getColumnNames()
    {
        // if (!is_null($this->$tableColumnNames)) { // TODO: здесь оптимизация не получилась, додумать если останется время
        //     return $this->$tableColumnNames;
        // }

        // $this->$tableColumnNames = $this->db->getColumnNames($this->getTableName());
        // return $this->$tableColumnNames;
        return $this->db->getColumnNames($this->getTableName());
    }

    public function delete()
    {
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $this->db->execute($sql, [':id' => $this->id]);
    }

    public function insert()
    {
        $columns = [];
        $params = [];
        
        foreach ($this->getColumnNames() as $key => $attr) {
            $params[":{$attr}"] = $this->{$attr};
            $columns[] = "`{$attr}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        // INSERT INTO products (id, name, description) VALUES (:id, :name, :descritpion)
        $sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function update()
    {
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