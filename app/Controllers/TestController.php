<?php
namespace App\Controllers;

use App\Core\BaseController;

/**
 * Controller para UI de geração de testes PHPUnit
 */
class TestController extends BaseController {
    /** @var array Lista de entidades e controllers para testes */
    private array $allTests = [
        'Revenda', 'Venda', 'Usuario',
        'AuthController', 'RevendaController', 'VendaController',
        'AdminController', 'TestController'
    ];

    /**
     * Exibe formulário responsivo de seleção
     */
    public function showForm(): void {
        $this->view('testes/index', ['tests' => $this->allTests]);
    }

    /**
     * Gera arquivos de teste com código boilerplate
     */
    public function generate(): void {
        $selected = $_POST['tests'] ?? [];
        $output = [];
        foreach ($selected as $test) {
            $class = sprintf('%sTest', ucfirst($test));
            $file = sprintf('%s.php', $class);
            $namespace = in_array($test, ['Revenda','Venda','Usuario'])
                ? 'Tests\\Models'
                : 'Tests\\Controllers';
            $code = <<<PHP
<?php
namespace {$namespace};
use PHPUnit\\Framework\\TestCase;

/**
 * Test placeholder para {$class}
 */
class {$class} extends TestCase {
    public function testPlaceholder(): void {
        \$this->assertTrue(true);
    }
}
PHP;
            $output[$file] = $code;
        }
        $this->view('testes/index', ['tests' => $this->allTests, 'output' => $output]);
    }
}
