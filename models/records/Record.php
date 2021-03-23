<?php

namespace app\models\records;

use app\interfaces\RecordInterface;
use app\services\Db;

abstract class Record
{
    public $excludedProperties =
    [
        'db',
        'tableName'
    ];
}
