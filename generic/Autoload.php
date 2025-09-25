<?php
/**
 * Autoload básico - Sistema simples de carregamento
 * Baseado no material da aula do professor
 */
spl_autoload_register(function($class) {
    $path = str_replace("\\", "/", $class);
    $basePath = dirname(__DIR__) . "/"; // Vai para a pasta raiz do projeto
    
    if (file_exists($basePath . $path . ".php")) {
        include $basePath . $path . ".php";
    }
});
?>