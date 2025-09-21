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

} elseif ($path === 'comentario/criar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rota para criar comentário
    require_once 'controllers/ComentarioController.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $controller = new ComentarioController($pdo);
    $ideiaId = isset($_POST['ideia_id']) ? (int)$_POST['ideia_id'] : null;
    $usuarioId = isset($_POST['usuario_id']) ? (int)$_POST['usuario_id'] : null;
    $texto = isset($_POST['texto']) ? trim($_POST['texto']) : '';
    if ($ideiaId && $usuarioId && $texto) {
        $controller->criar($ideiaId, $usuarioId, $texto);
    }
    // Redireciona de volta para a página principal
    header('Location: ' . BASE_URL);
    exit();
} else {
    // Rota não encontrada
    http_response_code(404);
    echo "<h1>Erro 404 - Página Não Encontrada</h1>";
    echo "A rota '{$path}' não foi encontrada.";
}

