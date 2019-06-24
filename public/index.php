<?php
mb_internal_encoding('UTF-8');
header('Content-Type: text/html; charset=utf-8');
include_once '../autoload.php';
define('ROOT_DIR', __DIR__ . '/../protected');

$rules = require_once(ROOT_DIR . '/config/rules.php');

$request = new \lib\http\Request($_GET, $_POST, $_SERVER, $_FILES);

$content = '';
$uri = $request->server('REQUEST_URI');
if (in_array($uri, array_keys($rules))) {
    $actionClass = new $rules[$uri]['action'];
    $content = $actionClass($request);
}

$response = new \lib\http\Response($content);
$response->send();
