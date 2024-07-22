<?php

namespace App\Routes;

use App\Controller\ValidatorController;

class Routes
{
    public function handleRequest()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];
        //var_dump($uri);
        //var_dump($method);

        if ($uri === 'validate-number' && $method === 'POST') {
            $controller = new ValidatorController();
            $controller->validate();
        } elseif ($uri === '' && $method === 'GET') {
            header("Content-Type: Application/json");
            echo 'Bem Vindo a API';
        } else {
            header("HTTP/1.0 404 Not Found");
            echo 'Page not found';
        }
    }
}
