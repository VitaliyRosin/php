<?php

// включает отображение ошибок в браузере
ini_set('display_errors', 1);

// чтобы видеть не только ошибки, но и предупреждения (warnings)
error_reporting(E_ALL);

// функция для дебага
function debug($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}