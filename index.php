<?php

require_once "app/lib/Development.php";

// исспользуем пространство имен app\core\Router чтоб потом не писать $Router = new app\core\Router;
use app\core\Router;

// функция PHP, которая регистрирует автозагрузчик классов
spl_autoload_register(function ($className) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className.'.php');
    if (file_exists($path)) {
        require_once $path;
    }
});

$Router = new Router;

session_start();

$Router->run();