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
    /** @var string */
    private $sessionCaptcha;

    /**
     * AuthService constructor.
     * @param BaseForm $userForm
     * @param string $sessionCaptcha
     */
    public function __construct(BaseForm $userForm, $sessionCaptcha = null)
    {
        $this->userForm = $userForm;
        $this->sessionCaptcha = $sessionCaptcha;
    }

    /**
     * @return bool
     */
    public function login()
    {
        $user = $this->findUser([
            'login' => $this->userForm->login,
        ]);

        if (!$user || !$this->verifyPassword($this->userForm->password, $user->password)) {
            $this->errors['all'][] = "Неправильный логин или пароль";
            return false;
        }
        $this->startSession($user->id);

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

        if (!$this->checkCaptcha($this->userForm->captchaCode)) {
            $this->errors['captcha'][] = 'Введён неправильный код капчи';
            return false;
        }

        if (!$user = $this->createUser()) {
            return false;
        }
        $this->startSession($user->id);

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
     * @return User
     */
    private function createUser()
    {
        $user = new User();
        $user->login = $this->userForm->login;
        $user->password = password_hash($this->userForm->password, PASSWORD_BCRYPT);
        $user->email = $this->userForm->email;

        if (!$user->insert(['login', 'password', 'email'])) {
            $this->errors = $user->getErrors();
            return null;
        }

        return $user;
    }

    /**
     * Запускает сессию и записывает в неё id пользователя
     * @param int $userId
     */
    private function startSession($userId)
    {
        $session = new Session();
        $session->start();
        $session->addKey(Session::SESSION_USER_ID, $userId);
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

    /**
     * @param string $captchaCode
     * @return bool
     */
    private function checkCaptcha($captchaCode)
    {
        return md5(trim($captchaCode)) === $this->sessionCaptcha;
    }
}
