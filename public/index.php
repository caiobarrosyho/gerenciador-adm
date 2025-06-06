<?php
/**
 * Autoload e inicialização de configuração
 */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

use App\Core\Router;

// Cria conexão mysqli global
try {
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($db->connect_error) {
        throw new Exception('Connection error: ' . $db->connect_error);
    }
} catch (Exception $e) {
    error_log($e->getMessage(), 3, __DIR__ . '/../logs/error.log');
    http_response_code(500);
    exit('Erro interno.');
}

// Inicia sessão para autenticação
session_start();

// Instancia e dispara o roteador
$router = new Router($db);
$router->dispatch();
