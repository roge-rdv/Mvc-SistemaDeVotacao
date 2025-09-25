<?php<?php

/**session_start();

 * Sistema de Votação de Ideias - MVC

 * Ponto de entrada principal// Mostrar erros para debug (remover em produção)

 */error_reporting(E_ALL);

include "../generic/Autoload.php";ini_set('display_errors', 1);



use generic\Controller;// Autoloader simples para carregar as classes

spl_autoload_register(function ($class) {

if (isset($_GET["param"])) {    $paths = [

    $controller = new Controller();        '../controllers/',

    $controller->verificarChamadas($_GET["param"]);        '../models/',

} else {        '../services/',

    // Página inicial        '../config/'

    ?>    ];

    <!DOCTYPE html>    

    <html>    foreach ($paths as $path) {

    <head>        $file = $path . $class . '.php';

        <title>Sistema de Votação de Ideias</title>        if (file_exists($file)) {

        <style>            require_once $file;

            body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }            return;

            .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }        }

            h1 { color: #333; text-align: center; }    }

            .menu { list-style: none; padding: 0; }    

            .menu li { margin: 15px 0; }    // Se chegou aqui, a classe não foi encontrada

            .menu a { display: block; padding: 12px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; text-align: center; }    throw new Exception("Classe '$class' não encontrada. Verificar se o arquivo existe nos diretórios: " . implode(', ', $paths));

            .menu a:hover { background: #0056b3; }});

        </style>

    </head>// Sistema de rotas simples com suporte a URLs amigáveis

    <body>$request_uri = $_SERVER['REQUEST_URI'] ?? '';

        <div class="container">$script_name = $_SERVER['SCRIPT_NAME'] ?? '';

            <h1>Sistema de Votação de Ideias</h1>

            <ul class="menu">// Remove o caminho base da URL

                <li><a href='?param=ideia/lista'>📋 Ver Todas as Ideias</a></li>$base_path = str_replace('/index.php', '', $script_name);

                <li><a href='?param=ideia/formulario'>💡 Cadastrar Nova Ideia</a></li>$route = str_replace($base_path, '', $request_uri);

            </ul>

        </div>// Remove query string se existir

    </body>$route = explode('?', $route)[0];

    </html>

    <?php// Remove barras extras

}$route = trim($route, '/');

?>
// Parse da rota
$segments = explode('/', $route);

// Determinar controller e action
if (isset($_GET['controller'])) {
    // URL antiga com query parameters (compatibilidade)
    $controller = $_GET['controller'] ?? 'ideia';
    $action = $_GET['action'] ?? 'index';
} else {
    // URL amigável: /controller/action/param
    $controller = $segments[0] ?? 'ideia';
    $action = $segments[1] ?? 'index';
    
    // Parâmetros adicionais
    if (isset($segments[2])) {
        $_GET['id'] = $segments[2];
    }
}

// Mapear rotas especiais
$route_map = [
    '' => ['controller' => 'ideia', 'action' => 'index'],
    'home' => ['controller' => 'ideia', 'action' => 'index'],
    'login' => ['controller' => 'usuario', 'action' => 'login'],
    'cadastro' => ['controller' => 'usuario', 'action' => 'cadastrar'],
    'perfil' => ['controller' => 'usuario', 'action' => 'perfil'],
    'logout' => ['controller' => 'usuario', 'action' => 'logout'],
    'nova-ideia' => ['controller' => 'ideia', 'action' => 'criar'],
    'minhas-ideias' => ['controller' => 'usuario', 'action' => 'minhasIdeias'],
    'meus-votos' => ['controller' => 'usuario', 'action' => 'meusVotos']
];

if (isset($route_map[$route])) {
    $controller = $route_map[$route]['controller'];
    $action = $route_map[$route]['action'];
}

try {
    switch ($controller) {
        case 'usuario':
            $controllerObj = new UsuarioController();
            break;
        case 'ideia':
            $controllerObj = new IdeiaController();
            break;
        case 'voto':
            $controllerObj = new VotoController();
            break;
        default:
            $controllerObj = new IdeiaController();
            $action = 'index';
            break;
    }
    
    // Verifica se o método existe no controller
    if (method_exists($controllerObj, $action)) {
        $controllerObj->$action();
    } else {
        // Método não encontrado, redireciona para home
        $controllerObj->index();
    }
    
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>