<?php
// Ponto de entrada e Roteador Simples

require_once 'autoload.php';
require_once 'config.php';

// Obtém o caminho da URL amigável a partir do parâmetro 'param' do .htaccess
$path = isset($_GET['url']) ? $_GET['url'] : '';

// Roteamento básico
if ($path === '') {
    // Rota padrão (página inicial)
    require_once 'controllers/IdeiaController.php';
    $controller = new IdeiaController();
    $controller->listar();
} elseif ($path === 'ideia/criar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rota para criar uma nova ideia (apenas método POST)
    require_once 'controllers/IdeiaController.php';
    $controller = new IdeiaController();
    $controller->criar();
} elseif (preg_match('/^ideia\/editar\/(\d+)$/', $path, $matches)) {
    // Rota para editar uma ideia
    $ideiaId = (int)$matches[1];
    require_once 'controllers/IdeiaController.php';
    $controller = new IdeiaController();
    $controller->editar($ideiaId);
} elseif (preg_match('/^ideia\/atualizar\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rota para atualizar uma ideia
    $ideiaId = (int)$matches[1];
    require_once 'controllers/IdeiaController.php';
    $controller = new IdeiaController();
    $controller->atualizar($ideiaId);
} else {
    // Rota não encontrada
    http_response_code(404);
    echo "<h1>Erro 404 - Página Não Encontrada</h1>";
    echo "A rota '{$path}' não foi encontrada.";
}

