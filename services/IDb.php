<?php
namespace app\services;

interface IDb {
    public function queryOne(string $sql): array;
    public function queryAll(string $sql): array;
    public function execute(string $sql, array $params);
}

interface ILog{
    public function log($message);
}

interface INotify{
    public function notify($message);
}