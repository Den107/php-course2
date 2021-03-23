<?php


namespace app\models\repositories;


use app\base\Application;
use app\interfaces\RepositoryInterface;
use app\models\records\Record;
use app\services\Db;


abstract class Repository implements RepositoryInterface
{
  protected $db;
  protected $tableName;


  public function __construct()
  {
    $this->db = Application::getInstance()->connection;
    $this->tableName = $this->getTableName();
  }


  public function getAll(array $ids = [])
  {
    $tableName = $this->getTableName();
    $where = '';

    if (!empty($ids)) {
      $placeholders = str_repeat('?,', count($ids) - 1) . '?';
      $where = " WHERE id IN ({$placeholders})";
    }

    $sql = "SELECT * FROM {$tableName}" . $where;
    return $this->getQuery($sql, $ids);
  }

  public function getById(int $id)
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";
    return $this->getQuery($sql, [':id' => $id])[0];
  }


  public function delete(Record $record)
  {
    $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
    return $this->db->execute($sql, [':id' => $record->id]);
  }


  public function insert(Record $record): Record
  {
    $tableName = $this->getTableName();

    $params = [];
    $columns = [];

    foreach ($record as $key => $value) {
      if (in_array($key, $record->excludedProperties)) {
        continue;
      }

      $params[":{$key}"] = $value;
      $columns[] = "`{$key}`";
    }

    $columns = implode(", ", $columns);
    $placeholders = implode(", ", array_keys($params));

    $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
    $this->db->execute($sql, $params);
    $record->id = $this->db->getLastInsertId();
    return $record;
  }


  public function update(Record $record)
  {
    $tableName = static::getTableName();

    $params = [];
    $setSection = [];

    foreach ($record as $key => $value) {
      if (in_array($key, $record->excludedProperties)) {
        continue;
      }

      $params[":{$key}"] = $value;
      $setSection[] = "`{$key}` = :{$key}";
    }

    $setSection = implode(", ", $setSection);

    $sql = "UPDATE {$tableName} SET {$setSection}";
    return $this->db->execute($sql, $params);
  }


  public function save(Record $record)
  {
    if (is_null($record->id)) {
      $this->insert($record);
    } else {
      $this->update($record);
    }
  }

  protected function getQuery(string $sql, array $params = [])
  {
    return $this->db->queryAll($sql, $params, $this->getRecordClass());
  }
}
