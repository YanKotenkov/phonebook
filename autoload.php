<?php

spl_autoload_register(function($class) {
    $file = ROOT_DIR . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("Could not find file $file");
    }
});
