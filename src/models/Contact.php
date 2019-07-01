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
    /** @var int */
    public $user_id;

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
     * @param int $userId
     * @param array $sort
     * @return ActiveRecord[]|Contact[]
     */
    public function getAll($userId, $sort = [])
    {
        $query = $this->find()->where(['user_id' => $userId]);
        if ($sort) {
            $query->sort($sort);
        }

        return $query->all();
    }
}
