<?php
namespace lib;

use models\User;

/**
 * Класс для работы с сессиями
 */
class Session
{
    /** @var string */
    const SESSION_USER_ID = 'session_user_id';
    /** @var User */
    private $user;

    /**
     * Старт сессии
     * @return bool
     */
    public function start()
    {
        if ($this->isActive()) {
            return true;
        }

        return session_start();
    }

    /**
     * "Убить" сессию
     */
    public function destroy()
    {
        if ($this->isActive()) {
            session_destroy();
        }
    }

    /**
     * @param string $key
     * @return null
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param string $key
     * @param int|string $value
     */
    public function addKey($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return !empty($_SESSION[$key]);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        if (is_null($this->user)) {
            $this->user = User::model()->findByPk($this->get(self::SESSION_USER_ID));
        }

        return $this->user;
    }

    /**
     * @return bool
     */
    private function isActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
