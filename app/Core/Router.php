<?php
namespace App\Core;

/**
 * Roteador MVC simples
 */
class Router {
    private \mysqli $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    /**
     * Dispara rota baseada em URI e método HTTP
     */
    public function dispatch(): void {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Rotas públicas
        if ($uri === '/login') {
            $ctrl = new \App\Controllers\AuthController($this->db);
            if ($method === 'POST') {
                $ctrl->login();
            } else {
                $ctrl->showLogin();
            }
            return;
        }
        // Verifica autenticação
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        // Rotas protegidas
        switch (true) {
            case $uri === '/admin' && $method === 'GET':
                (new \App\Controllers\AdminController($this->db))->dashboard();
                break;
            case preg_match('#^/revendas#', $uri):
                (new \App\Controllers\RevendaController($this->db))->handle($method, $uri);
                break;
            case preg_match('#^/vendas#', $uri):
                (new \App\Controllers\VendaController($this->db))->handle($method, $uri);
                break;
            case $uri === '/testes':
                $ctrl = new \App\Controllers\TestController($this->db);
                if ($method === 'POST') {
                    $ctrl->generate();
                } else {
                    $ctrl->showForm();
                }
                break;
            default:
                http_response_code(404);
                echo 'Página não encontrada';
        }
    }
}
