<?php

namespace app\core;
class Router {
    protected $routes = [];
    protected $params = [];
    public function __construct() {
        $arr = require 'app/config/routes.php';
        foreach ($arr as $key => $value) {
            $this->addRoute($key, $value);
        }
        //debug($this->routes);
    }
    public function addRoute($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }
    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function run()
    {
        if ($this->match()){
            $path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)) {
                echo ucfirst($this->params['controller']) . 'Controller' . ' controller found'.'<br>';
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    echo $action . ' action found'.'<br>';
                    $controller = new $path($this->params);
                    $controller->$action();
                }
                else
                    echo  $action . ' action  not found'.'<br>';;
            }
            else
                echo ucfirst($this->params['controller']) . 'Controller' . ' controller not found'.'<br>';;
        }
        else
            echo 'Route not found'.'<br>';
    }
}
