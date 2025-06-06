<?php
namespace App\Controllers;

use App\Core\BaseController;

/**
 * Controlador de autenticação simples
 */
class AuthController extends BaseController {
    public function showLogin(): void {
        echo 'Login form placeholder';
    }

    public function login(): void {
        // Aqui deveria validar usuário
        $_SESSION['user'] = 'demo';
        header('Location: /admin');
    }
}
