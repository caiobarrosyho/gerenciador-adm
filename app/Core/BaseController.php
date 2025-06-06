<?php
namespace App\Core;

/**
 * Classe base para controllers
 */
class BaseController {
    protected \mysqli $db;
    protected array $data = [];

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    /**
     * Renderiza view com os dados
     */
    protected function view(string $path, array $params = []): void {
        extract($params);
        include __DIR__ . '/../Views/' . $path . '.php';
    }
}
