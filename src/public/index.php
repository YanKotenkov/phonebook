<?php
mb_internal_encoding('UTF-8');
include_once '../autoload.php';
define('ROOT_DIR', __DIR__ . '/../');
define('VIEW_PATH', ROOT_DIR . '/views/');
define('MYSQL_HOST', getenv('MYSQL_HOST'));
define('MYSQL_DATABASE', getenv('MYSQL_DATABASE'));
define('MYSQL_USER', getenv('MYSQL_USER'));
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD'));

$config = require_once(ROOT_DIR . '/config/main.php');

$request = new \lib\http\Request($_GET, $_POST, $_SERVER, $_FILES);

$urlResolver = new \lib\base\UrlResolver(
    $config['routes'],
    $request
);
$action = $urlResolver->getAction();
/** @var \lib\http\Response $response */
$response = $action($request);
$response->send();
