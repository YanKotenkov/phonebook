<?php
namespace lib;

use PDO;
use PDOStatement;

/**
 * Обёртка для работы с БД
 */
abstract class ActiveRecord
{
    /** @var string */
    private $query;
    /** @var array */
    private $where = [];
    /** @var array */
    private $sort;
    /**
     * @var array
     */
    private $errors;

    /** @return string */
    abstract function tableName();

    /** @return string */
    abstract function primaryKey();

    /**
     * @return PDO|null
     */
    public static function getDb()
    {
        return DbConnection::getInstance();
    }

    /**
     * @return static
     */
    public static function model()
    {
        return new static();
    }

    /**
     * @return $this
     */
    public function find()
    {
        $this->query = "SELECT * FROM {$this->tableName()} ";

        return $this;
    }

    /**
     * @param array $where
     * @return $this
     */
    public function where(array $where)
    {
        $this->where = $where;

        return $this;
    }

    /**
     * @return static|ActiveRecord
     */
    public function one()
    {
        $sth = $this->prepareQuery();
        $sth->execute();

        return $sth->fetchObject(static::class);
    }

    /**
     * @param int $id
     * @return static|ActiveRecord
     */
    public function findByPk($id)
    {
        $this->query = "SELECT * FROM {$this->tableName()} ";
        $this->where = [$this->primaryKey() => $id];
        $sth = $this->prepareQuery();
        $sth->execute();

        return $sth->fetchObject(static::class);
    }

    /**
     * @return static[]|ActiveRecord[]
     */
    public function all()
    {
        $sth = $this->prepareQuery();
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    /**
     * @param array $sort
     */
    public function sort(array $sort)
    {
        $this->sort = $sort;
    }

    /**
     * @param array $fieldNames
     * @return bool
     */
    public function insert(array $fieldNames)
    {
        $insertFields = implode(', ', $fieldNames);
        $insertValues = ':' . implode(', :', $fieldNames);

        $this->query = "INSERT INTO {$this->tableName()} ({$insertFields}) VALUES ({$insertValues})";

        $db = self::getDb();
        $sth = $db->prepare($this->query);

        $this->bindValues($sth, $fieldNames);

        if (!$sth->execute()) {
            $this->errors[] = $sth->errorInfo();
            return false;
        }

        $this->{$this->primaryKey()} = $db->lastInsertId();

        return true;
    }

    /**
     * @param array $fieldNames
     * @return bool
     */
    public function update(array $fieldNames)
    {
        $update = [];
        foreach ($fieldNames as $field) {
            $update[] = "{$field} = :{$field}";
        }
        $updateFields = implode(', ', $update);

        $pkField = $this->primaryKey();

        $this->query = "UPDATE {$this->tableName()} SET {$updateFields} WHERE {$pkField} = :{$pkField}";

        $db = self::getDb();
        $sth = $db->prepare($this->query);
        $sth->bindValue(":{$pkField}", $this->{$pkField});
        $this->bindValues($sth, $fieldNames);

        if (!$sth->execute()) {
            $this->errors[] = $sth->errorInfo();
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id)
    {
        $db = self::getDb();
        $this->query = "DELETE FROM {$this->tableName()} WHERE ID = :id";
        $sth = $db->prepare($this->query);
        $sth->bindValue(':id', $id);
        if (!$sth->execute()) {
            $this->errors[] = $sth->errorInfo();
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool|PDOStatement
     */
    private function prepareQuery()
    {
        $db = self::getDb();
        if ($this->where) {
            $this->query .= ' WHERE ';
        }
        foreach (array_keys($this->where) as $key => $name) {
            if ($key !== 0 && $key !== (count($this->where))) {
                $this->query .= ' AND ';
            }
            $this->query .= "$name = :$name";
        }

        if ($this->sort) {
            $this->query .= ' ORDER BY ';
            foreach ($this->sort as $field => $order) {
                $this->query .= "{$field} $order";
            }
        }

        $sth = $db->prepare($this->query);
        foreach ($this->where as $name => $value) {
            $sth->bindValue(":$name", $value);
        }

        return $sth;
    }

    /**
     * @param PDOStatement $sth
     * @param array $fieldNames
     */
    private function bindValues($sth, array $fieldNames)
    {
        foreach ($fieldNames as $field) {
            $sth->bindValue(":$field", $this->{$field});
        }
    }
}
