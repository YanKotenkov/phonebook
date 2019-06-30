<?php
namespace forms;

class RegisterForm extends UserForm
{
    /** @var string */
    public $email;

    /** @inheritdoc */
    public function getRequiredFields()
    {
        return [
            'login',
            'password',
            'email',
        ];
    }
}
