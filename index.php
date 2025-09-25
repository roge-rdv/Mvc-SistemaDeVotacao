
<?php
// Ponto de entrada e Roteador Simples


session_start();
require_once 'autoload.php';
require_once 'config.php';

// Obtém o caminho da URL amigável a partir do parâmetro 'param' do .htaccess
$path = isset($_GET['url']) ? $_GET['url'] : '';

// Roteamento básico
if ($path === '') {
    // Proteger rota principal: só acessa se estiver logado
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit();
    }
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

} elseif (preg_match('/^ideia\/excluir\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rota para excluir uma ideia
    require_once 'controllers/IdeiaController.php';
    $controller = new IdeiaController();
    $ideiaId = (int)$matches[1];
    $controller->excluir($ideiaId);

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

} elseif ($path === 'voto/votar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'controllers/VotoController.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $controller = new VotoController($pdo);
    $ideiaId = isset($_POST['ideia_id']) ? (int)$_POST['ideia_id'] : null;
    $usuarioId = isset($_POST['usuario_id']) ? (int)$_POST['usuario_id'] : null;
    if ($ideiaId && $usuarioId) {
        $controller->votar($usuarioId, $ideiaId);
    }
    header('Location: ' . BASE_URL);
    exit();

} elseif ($path === 'voto/desvotar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'controllers/VotoController.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $controller = new VotoController($pdo);
    $ideiaId = isset($_POST['ideia_id']) ? (int)$_POST['ideia_id'] : null;
    $usuarioId = isset($_POST['usuario_id']) ? (int)$_POST['usuario_id'] : null;
    if ($ideiaId && $usuarioId) {
        $controller->desvotar($usuarioId, $ideiaId);
    }
    header('Location: ' . BASE_URL);
    exit();


} elseif ($path === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    if ($auth->login($email, $senha)) {
        header('Location: ' . BASE_URL);
    } else {
        echo '<p style="color:red;">Login inválido!</p>';
        require 'views/login.php';
    }
    exit();

} elseif ($path === 'login') {
    require 'views/login.php';
    exit();

} elseif ($path === 'logout') {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->logout();
    header('Location: ' . BASE_URL);
    exit();


} elseif ($path === 'admin/dashboard') {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    if ($auth->isAdmin()) {
        require 'views/admin/dashboard.php';
    } else {
        http_response_code(403);
        echo '<h2>Acesso negado. Apenas administradores podem acessar.</h2>';
    }
    exit();

} elseif ($path === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'controllers/RegisterController.php';
    $register = new RegisterController();
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $is_admin = isset($_POST['is_admin']) ? (int)$_POST['is_admin'] : 0;
    if ($register->register($nome, $email, $senha, $is_admin)) {
        echo '<p style="color:green;">Cadastro realizado com sucesso! Faça login.</p>';
        require 'views/login.php';
    } else {
        echo '<p style="color:red;">Erro ao cadastrar usuário.</p>';
        require 'views/register.php';
    }
    exit();

} elseif ($path === 'register') {
    require 'views/register.php';
    exit();

} else {
    // Rota não encontrada
    http_response_code(404);
    echo "<h1>Erro 404 - Página Não Encontrada</h1>";
    echo "A rota '{$path}' não foi encontrada.";
}

