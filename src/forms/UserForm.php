<?php
namespace forms;

class UserForm extends \lib\BaseForm
{
    /** @var string */
    public $login;
    /** @var string */
    public $password;

    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'ins_date' => 'Дата добавления',
        ];
    }

    /** @inheritdoc */
    public function getRequiredFields()
    {
        return [
            'login',
            'password',
        ];
    }
}
