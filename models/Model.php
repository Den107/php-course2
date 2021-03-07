<?php

namespace app\models;

use app\interfaces\ModelInterface;
use app\services\Db;

abstract class Model implements ModelInterface
{
    protected $db;
    protected $tableName;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = new Db();
        $this->tableName = $this->getTableName();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tableName}";
        $result = $this->db->queryAll($sql);
        $object = new static();
        foreach ($result as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $object->$key = $value;
            }
        }
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        $result = $this->db->queryOne($sql);
        $object = new static();
        foreach ($result as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $object->$key = $value;
            }
        }
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = {$id}";
        $result = $this->db->execute($sql);
        $object = new static();
        foreach ($result as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $object->$key = $value;
            }
        }
    }

    public function insert()
    {
        $tableName = $this->getTableName();

        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if (in_array($key, ['db', 'tableName'])) {
                continue;
            }
            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }
        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLastInsertId();
    }

    protected function getQuery(string $sql, array $params = [])
    {
        return $this->db->queryAll($sql, $params, get_called_class());
    }
}
