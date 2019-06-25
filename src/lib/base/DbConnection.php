<?php
namespace lib\base;

use PDO;

class DbConnection
{
    private static $instance = null;
    private $connection;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = (new self())->connection;
        }

        return self::$instance;
    }

    private function __construct()
    {
        $dsn = 'mysql:host=' . MYSQL_HOST . '; dbname=' . MYSQL_DATABASE;
        $this->connection = new PDO(
            $dsn,
            MYSQL_USER,
            MYSQL_PASSWORD,
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            ]
        );
    }

    private function __clone () {}
    private function __wakeup () {}
}
