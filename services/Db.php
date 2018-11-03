<?php

namespace app\services;

use app\traits\TSingleton;
use app\models\Product as MD;

class Db
{
    private $config = [
    ];

    protected $conn = null;

    /**
     * Db constructor.
     */
    public function __construct($driver, $host, $login, $password, $database, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    protected function getConnection()
    {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );

            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        
        return $this->conn;
    }

    private function query(string $sql, array $params = [])
    {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryOne(string $sql, string $className, array $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryObjects($sql, $params = [], $class)
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $smtp->fetchAll();
    }

    public function queryObject($sql, $params = [], $class)
    {
        return $this->queryObjects($sql, $params, $class)[0];
    }

    public function queryAll(string $sql, string $className, array $params = [])
    {   
        //return $this->query($sql, $params)->fetchAll();
        return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    public function getColumnNames($table){
        $sql = "SELECT COLUMN_NAME 
                FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE table_name = :table";
        
        $smtp = $this->query($sql, [':table' => $table]);
        $rows = $smtp->fetchAll(\PDO::FETCH_ASSOC); 
        return array_column($rows, 'COLUMN_NAME');
    }

    private function prepareDsnString(): string
    {
        //mysql:host=$host;dbname=$db;charset=$charset
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }
}