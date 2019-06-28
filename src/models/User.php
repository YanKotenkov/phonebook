<?php
namespace models;

use lib\ActiveRecord;

/**
 * @method self one()
 */
class User extends ActiveRecord
{
    /** @var int */
    public $id;
    /** @var string */
    public $login;
    /** @var string */
    public $password;
    /** @var string */
    public $email;
    /** @var string */
    public $ins_date;

    /** @inheritDoc */
    public function tableName()
    {
        return 'user';
    }

    /** @inheritDoc */
    public function primaryKey()
    {
        return 'id';
    }

    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'ins_date' => 'Дата добавления',
        ];
    }
}
