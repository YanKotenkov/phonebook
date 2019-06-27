<?php
namespace services;

use models\User;

class AuthService
{
    /** @var User */
    public $user;

    /**
     * AuthService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function login()
    {
        $findUser = User::model()->find()->where([
            'login' => $this->user->login,
            'password' => $this->user->password,
        ])->one();

        return (bool)$findUser;
    }
}
