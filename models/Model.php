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
        $this->db = Db::getInstance();
        $this->tableName = $this->getTableName();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->getQuery($sql);
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->getQuery($sql, [':id' => $id])[0];
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }

    protected function getQuery(string $sql, array $params = [])
    {
        return $this->db->queryAll($sql, $params, get_called_class());
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

    public function update()
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

        $sql = "UPDATE {$tableName} SET ({$columns}) = ({$placeholders})";
        $this->db->execute($sql, $params);
    }
}
