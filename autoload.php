<?php

spl_autoload_register(function ($className) {
    // Converte o nome da classe (com namespace) para um caminho de arquivo.
    $path = __DIR__ . '/' . str_replace('\\', '/', ($className)) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});
