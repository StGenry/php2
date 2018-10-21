<?php

namespace app\services;

use app\traits\TSingleton;
use app\models\Product as MD;

class Db
{
    use TSingleton;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'gb_db',
        'charset' => 'utf8'
    ];

    protected $conn = null;

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

    // "SELECT * FROM products WHERE id = :id"  0 OR 1 = 1

    /*
     * [ ':id' => 1]
     */
    private function query(string $sql, array $params = [])
    {
        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryOne(string $sql, string $className, array $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryObject($sql, $params = [], $class)
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $smtp->fetch();
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



// <?php
// namespace app\services;

// class Db implements IDb
// {
//     private $conn = null;
//     private $host = null;
//     private $user = null;
//     private $password = null;
//     private $name = null;
    
//     public function __construct(string $host = 'localhost', string $user = 'root', string $password = '', string $name = 'gb_db')
//     {
//         $this->host = $host;
//         $this->user = $user;
//         $this->password = $password;
//         $this->name = $name;
//     }

//     protected function getConnection(){
//         if(is_null($this->$conn)){
//             $this->$conn = mysqli_connect($this->host, $this->user, $this->password, $this->name);
//         }
//         return $this->$conn;
//     }
    
//     protected function execute(string $sql){
//         return mysqli_query($this->getConnection(), $sql);
//     }
    
//     public function closeConnection(){
//         return mysqli_close($this->getConnection());
//     }
    
//     public function queryAll(string $sql): array{
//         return mysqli_fetch_all($this->execute($sql), MYSQLI_ASSOC);
//     }
    
//     public function queryOne(string $sql): array{
//         return mysqli_fetch_array($this->execute($sql), MYSQLI_ASSOC);
//     }
//  }
