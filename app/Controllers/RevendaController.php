<?php
namespace App\Controllers;

use App\Core\BaseController;

/**
 * Controlador de revendas
 */
class RevendaController extends BaseController {
    public function handle(string $method, string $uri): void {
        echo "Revenda {$method} {$uri}";
    }
}
