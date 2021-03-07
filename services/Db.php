<?php

namespace app\services;

class Db
{

    private $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'login' => 'mysql',
        'password' => 'mysql',
        'dbName' => 'shop',
        'charset' => 'utf8',
    ];

    protected $connection = null;

    protected function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO(
                $this->buildDsnString(),
                $this->config['login'],
                $this->config['password'],
            );

            $this->connection->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }

        return $this->connection;
    }
    protected function buildDsnString(): string
    {
        return sprintf(
            '%s:dbname=%s;host=%s;charset=%s',
            $this->config['driver'],
            $this->config['dbName'],
            $this->config['host'],
            $this->config['charset'],
        );
    }
    public function queryOne($sql)
    {
        return [];
    }

    public function queryAll($sql)
    {
        return [];
    }

    public function execute($sql)
    {
        return [];
    }
    public function getLastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}
