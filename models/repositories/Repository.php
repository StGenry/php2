<?php


namespace app\models\repositories;


use app\models\DataEntity;
use app\services\Db;
use app\base\App;

abstract class Repository implements IRepository
{
    private $db;

    public function __construct() {
        $this->db = static::getDb();
    }

    private static function getDb(){
        return App::call()->db;
    }

    public function getOne($id) {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $foundData = $this->find($sql, [':id' => $id]);
        return empty($foundData) ? false : $foundData[0];
        // return $this->db->queryObject($sql, [':id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        //return $this->find($sql, [])[0];
        return $this->db->queryAll($sql, $this->getEntityClass());
    }

    public function getColumnNames() {
        return $this->db->getColumnNames($this->getTableName());
    }

    public function getTableColumns() {
        if (!is_null($this::$tableColumns)) {
            return $this::$tableColumns;
        }

        $this::$tableColumns = $this->db->getColumnNames($this->getTableName());
        return $this::$tableColumns;
    }

    public function delete(DataEntity $entity) {
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $this->db->execute($sql, [':id' => $entity->id]);
    }

    public function insert(DataEntity $entity) {
        $columns = [];
        $params = [];
        
        foreach ($this->getColumnNames() as $key => $attr) {
        //foreach ($this->getTableColumns() as $key => $attr) {
            $params[":{$attr}"] = $entity->{$attr};
            $columns[] = "`{$attr}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        $sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function update(DataEntity $entity) {
        $columns = [];
        $params = [':id' => $entity->id];
        
        foreach ($this->getColumnNames() as $key => $attr) {
        //foreach ($this->getTableColumns() as $key => $attr) {
                if (is_null($entity->{$attr})) { // чтобы реквизиты не перезатирались, если не были заполнены
                continue;
            }
            $params[":{$attr}"] = $entity->{$attr};
            $columns[] = "{$attr} = :{$attr}";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        $sql = "UPDATE `{$table}` SET {$columns} WHERE id = :id";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function save(DataEntity $entity) {
        if (isset($entity->id) && $this->getOne($entity->id)) {
            $this->update($entity);
        } else {
            $this->insert($entity);
        }
    }

    public function find($sql, $params)
    {
        return $this->db->queryObjects($sql, $params, $this->getEntityClass());
    }
}