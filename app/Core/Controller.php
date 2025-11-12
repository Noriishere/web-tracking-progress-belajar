<?php
namespace FpSmt3\WebTracker\Core;

class Controller {
    public function view($view, $data = []) {
        // Ekstrak data agar bisa dipakai langsung di view
        extract($data);

        // Buat path lengkap view-nya
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        // Cek dulu file-nya ada gak
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View file not found: " . $viewPath);
        }
    }

    public function model($model) {
        $modelPath = __DIR__ . '/../Models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $modelClass = "FpSmt3\\WebTracker\\Models\\$model";
            return new $modelClass;
        } else {
            die("Model file not found: " . $modelPath);
        }
    }
}
