<?php
namespace App\Controllers;

use App\Core\BaseController;

/**
 * Controlador de vendas
 */
class VendaController extends BaseController {
    public function handle(string $method, string $uri): void {
        echo "Venda {$method} {$uri}";
    }
}
