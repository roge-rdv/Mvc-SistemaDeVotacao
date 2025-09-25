<?php
session_start();

// Mostrar erros para debug (remover em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoloader simples para carregar as classes
spl_autoload_register(function ($class) {
    $paths = [
        '../controllers/',
        '../models/',
        '../services/',
        '../config/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    
    // Se chegou aqui, a classe não foi encontrada
    throw new Exception("Classe '$class' não encontrada. Verificar se o arquivo existe nos diretórios: " . implode(', ', $paths));
});

// Sistema de rotas simples
$action = $_GET['action'] ?? 'home';
$controller = $_GET['controller'] ?? 'ideia';

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