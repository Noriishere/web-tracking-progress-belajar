<?php

namespace FpSmt3\WebTracker\Core;

class App {
    protected $folder = '';
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        if (!empty($url[0]) && strtolower($url[0]) === 'admin') {
            $this->folder = 'Admin';
            unset($url[0]);
            $url = array_values($url);
        } elseif (!empty($url[0]) && strtolower($url[0]) === 'user') {
            $this->folder = 'User';
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

        $controllerClass = $this->folder
            ? "FpSmt3\\WebTracker\\Controllers\\{$this->folder}\\{$this->controller}"
            : "FpSmt3\\WebTracker\\Controllers\\{$this->controller}";

        if (!class_exists($controllerClass)) {
            http_response_code(404);
            echo "Controller not found";
            exit;
        }

        $this->controller = new $controllerClass;
        $this->params = $url ? array_values($url) : [];

        if (!method_exists($this->controller, $this->method)) {
            http_response_code(404);
            echo "Method not found";
            exit;
        }

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
