<?php
/**
 * Teste do sistema básico
 */
include "../generic/Autoload.php";

use generic\Controller;

echo "<h2>Teste do Sistema MVC Básico</h2>";

echo "<p>1. Testando include do Autoload...</p>";
echo "<p>✅ Autoload incluído com sucesso!</p>";

echo "<p>2. Testando classes...</p>";
try {
    echo "<p>✅ Namespace generic\\Controller carregado!</p>";
    
    $controller = new Controller();
    echo "<p>✅ Controller instanciado com sucesso!</p>";
    
    echo "<p>3. Links de teste:</p>";
    echo "<ul>";
    echo "<li><a href='index-basico.php?param=ideia/lista'>Lista de Ideias</a></li>";
    echo "<li><a href='index-basico.php?param=ideia/formulario'>Nova Ideia</a></li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p>❌ Erro: " . $e->getMessage() . "</p>";
}
?>