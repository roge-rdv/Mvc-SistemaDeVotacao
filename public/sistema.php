<?php
/**
 * Sistema de Votação de Ideias - MVC
 * Ponto de entrada principal
 */
include "../generic/Autoload.php";

use generic\Controller;

if (isset($_GET["param"])) {
    $controller = new Controller();
    $controller->verificarChamadas($_GET["param"]);
} else {
    // Página inicial
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Sistema de Votação de Ideias</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
            .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            h1 { color: #333; text-align: center; }
            .menu { list-style: none; padding: 0; }
            .menu li { margin: 15px 0; }
            .menu a { display: block; padding: 12px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; text-align: center; }
            .menu a:hover { background: #0056b3; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Sistema de Votação de Ideias</h1>
            <ul class="menu">
                <li><a href='?param=ideia/lista'>📋 Ver Todas as Ideias</a></li>
                <li><a href='?param=ideia/formulario'>💡 Cadastrar Nova Ideia</a></li>
            </ul>
        </div>
    </body>
    </html>
    <?php
}
?>