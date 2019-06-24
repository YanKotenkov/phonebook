<?php
mb_internal_encoding('UTF-8');
header('Content-Type: text/html; charset=utf-8');
include_once '../autoload.php';
define('ROOT_DIR', __DIR__ . '/../protected');

$config = require_once(ROOT_DIR . '/config/main.php');

$request = new \lib\http\Request($_GET, $_POST, $_SERVER, $_FILES);

$urlResolver = new \lib\base\UrlResolver(
    $config['routes'],
    $request
);
$action = $urlResolver->getAction();
$content = $action($request);

$response = new \lib\http\Response($content);
$response->send();
