<?php
namespace models;

use lib\ActiveRecord;

class Contact extends ActiveRecord
{
    /** @var int */
    public $id;
    /** @var string */
    public $name;
    /** @var string */
    public $second_name;
    /** @var mixed */
    public $photo;
    /** @var string */
    public $email;
    /** @var string */
    public $phone;

    /** @inheritdoc */
    public function tableName()
    {
        return 'contact';
    }

    /** @inheritdoc */
    public function primaryKey()
    {
        return 'id';
    }

    /**
     * @return ActiveRecord[]|Contact[]
     */
    public function getAll($sort = [])
    {
        $query = $this->find();
        if ($sort) {
            $query->sort($sort);
        }

        return $query->all();
    }
}
