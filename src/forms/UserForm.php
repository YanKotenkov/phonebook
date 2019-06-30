<?php
namespace forms;

class UserForm extends \lib\BaseForm
{
    /** @var string */
    public $login;
    /** @var string */
    public $password;
    /** @var string */
    public $passwordConfirm;

    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'ins_date' => 'Дата создания',
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
