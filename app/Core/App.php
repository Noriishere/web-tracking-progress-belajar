<?php

namespace FpSmt3\WebTracker\Core;

class App {
    protected $folder = 'User';
    protected $controller = 'Auth';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        if (!empty($url[0]) && in_array(strtolower($url[0]), ['admin', 'user'])) {
            $this->folder = ucfirst(strtolower($url[0]));
            unset($url[0]);
            $url = array_values($url);
        }

        if (!empty($url[0])) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        if (!empty($url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $controllerClass = "FpSmt3\\WebTracker\\Controllers\\{$this->folder}\\{$this->controller}";

        if (!class_exists($controllerClass)) {
            $controllerClass = "FpSmt3\\WebTracker\\Controllers\\User\\Auth";
            $this->controller = new $controllerClass;
            call_user_func_array([$this->controller, $this->method], []);
            return;
        }

        $this->controller = new $controllerClass;
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}