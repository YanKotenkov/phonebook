<?php
namespace services;

use forms\RegisterForm;
use forms\UserForm;
use lib\BaseForm;
use lib\Session;
use models\User;

/**
 * Класс для аутентификации
 */
class AuthService
{
    /** @var BaseForm|UserForm|RegisterForm */
    public $userForm;
    /** @var array */
    public $errors = [];

    /**
     * AuthService constructor.
     * @param BaseForm $userForm
     */
    public function __construct(BaseForm $userForm)
    {
        $this->userForm = $userForm;
    }

    /**
     * @return bool
     */
    public function login()
    {
        $user = $this->findUser([
            'login' => $this->userForm->login,
        ]);

        if (!$user) {
            $this->errors['login'][] = "Пользователь с таким логином не найден";
            return false;
        }

        if (!$this->verifyPassword($this->userForm->password, $user->password)) {
            $this->errors['password'][] = "Неправильный пароль";
            return false;
        }

        $session = new Session();
        $session->start();
        $session->addKey(Session::SESSION_USER_ID, $user->id);

        return true;
    }

    /**
     * Регистрация
     * @return bool
     */
    public function register()
    {
        if ($this->findUser(['login' => $this->userForm->login])) {
            $this->errors['login'][] = 'Пользователь с таким логином уже существует';
            return false;
        }

        if ($this->findUser(['email' => $this->userForm->email])) {
            $this->errors['email'][] = 'Пользователь с таким email уже существует';
            return false;
        }

        if (!$this->createUser()) {
            return false;
        }

        return true;
    }

    /**
     * @param array $where
     * @return User
     */
    private function findUser(array $where)
    {
        return User::model()->find()->where($where)->one();
    }

    /**
     * Создание пользователя
     * @return bool
     */
    private function createUser()
    {
        $user = new User();
        $user->login = $this->userForm->login;
        $user->password = password_hash($this->userForm->password, PASSWORD_BCRYPT);
        $user->email = $this->userForm->email;

        if (!$user->insert(['login', 'password', 'email'])) {
            $this->errors = $user->getErrors();
            return false;
        }

        return true;
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    private function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
