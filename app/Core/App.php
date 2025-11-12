<?php

namespace FpSmt3\WebTracker\Core;

class App {
    protected $folder = 'User';      // ✅ Default folder jadi User, bukan Admin
    protected $controller = 'Auth';  // ✅ Default controller jadi Auth
    protected $method = 'index';     // ✅ Default method jadi index
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 🗂 Jika URL pertama adalah nama folder (admin/user/auth)
        if (!empty($url[0]) && in_array(strtolower($url[0]), ['admin', 'user', 'auth'])) {
            $this->folder = ucfirst(strtolower($url[0]));
            unset($url[0]);
        }

        // 🧭 Tentukan nama controller
        if (!empty($url[1])) {
            $this->controller = ucfirst($url[1]);
            unset($url[1]);
        } elseif (!empty($url[0])) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        // 🧩 Buat namespace lengkap untuk controller
        $controllerNamespace = "FpSmt3\\WebTracker\\Controllers";
        if (!empty($this->folder)) {
            $controllerClass = $controllerNamespace . "\\" . $this->folder . "\\" . $this->controller;
        } else {
            $controllerClass = $controllerNamespace . "\\" . $this->controller;
        }

        // 🧱 Cek apakah class controller-nya ada
        if (!class_exists($controllerClass)) {
            // Fallback ke default Auth (biar gak error)
            $controllerClass = "FpSmt3\\WebTracker\\Controllers\\User\\Auth";
        }

        // 🪄 Instansiasi controller
        $this->controller = new $controllerClass;

        // ⚙️ Tentukan method
        if (isset($url[2]) && method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
            unset($url[2]);
        } elseif (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // 📦 Ambil parameter sisa
        $this->params = $url ? array_values($url) : [];

        // 🚀 Jalankan controller + method
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