<?php

namespace app\core;
abstract class Controller {
    public $route;
    public function __construct($route) {
        echo 'Hi there!';
        $this->route = $route;
        var_dump($this->route);
    }
}
