<?php

namespace App;

use http\Params;

abstract class Model
{
    const TABLE = '';

    public $id;

    //public $data; Может выводить findAll() в массив и показывать из него? Чтобы базу каждый раз не дергать

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY `id` DESC';
        return $db->query(
            $sql,
            [],
            static::class
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function findById(int $id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `id` = :id';
        $resArray = $db->query(
            $sql,
            [
                ':id' => $id,
            ],
            static::class
        );
        return $resArray ? $resArray[0] : null;
    }

    /**
     * @return bool|mixed|void
     */
    public function save()
    {
        if (!$this->isNew()) {
            return;
        }

        $db = new Db();

        $fieldNames = [];
        $values = [];

        foreach ($this as $fieldName => $value) {
            if ('id' == $fieldName) {
                continue;
            }
            $fieldNames[] = $fieldName;
            $values[':' . $fieldName] = $value;
        }

       $sql = 'INSERT INTO ' . static::TABLE
            . ' (' . implode(', ', $fieldNames) . ') 
            VALUES 
            (' . implode(', ', array_keys($values)) . ')';
        $res = $db->execute(
            $sql,
            $values
        );

        if (true === $res) {
            $this->id = $db->getLastId();
        }

        return $res;
    }

    /**
     * @param $id
     */
    public static function delete($id)
    {
        $db = new Db();
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE `id` = :id';
        $db->execute(
            $sql,
            [
                'id' => $id,
            ]
        );
    }

    /**
     * @return bool
     */
    protected function isNew(): bool
    {
        return empty($this->id);
    }
}