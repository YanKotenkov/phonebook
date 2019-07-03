<?php
namespace forms;

class RegisterForm extends UserForm
{
    /** @var string */
    public $email;
    /** @var string */
    public $captchaCode;

    /** @inheritdoc */
    public function getRequiredFields()
    {
        return [
            'login',
            'password',
            'email',
            'captchaCode',
        ];
    }
}
