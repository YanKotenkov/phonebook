<?php
mb_internal_encoding('UTF-8');
include_once '../autoload.php';

define('ROOT_DIR', __DIR__ . '/../');

$config = require_once(ROOT_DIR . '/config/main.php');

define('VIEW_PATH', ROOT_DIR . '/views/');
define('MYSQL_HOST', getenv('MYSQL_HOST') ?: $config['db']['host']);
define('MYSQL_DATABASE', getenv('MYSQL_DATABASE') ?: $config['db']['database']);
define('MYSQL_USER', getenv('MYSQL_USER') ?: $config['db']['user']);
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD') ?: $config['db']['password']);

$request = new \lib\http\Request($_GET, $_POST, $_SERVER, $_FILES);

$urlResolver = new lib\UrlResolver(
    $config['routes'],
    $request
);
$action = $urlResolver->getAction();
/** @var \lib\http\Response $response */
$response = $action($request);
$response->send();
