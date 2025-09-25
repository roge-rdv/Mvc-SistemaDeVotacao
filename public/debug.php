<?php
// Teste de debug para verificar se as classes estão sendo carregadas
echo "<h1>Teste de Debug - Sistema MVC</h1>";

// Definir caminhos absolutos
$base_path = dirname(__DIR__);

echo "<h2>Testando Caminhos:</h2>";
echo "Base path: " . $base_path . "<br>";

$paths_to_check = [
    'config/Database.php',
    'models/UsuarioDAO.php',
    'models/IdeiaDAO.php', 
    'models/VotoDAO.php',
    'services/UsuarioService.php',
    'services/IdeiaService.php',
    'services/VotoService.php',
    'controllers/UsuarioController.php',
    'controllers/IdeiaController.php',
    'controllers/VotoController.php'
];

echo "<h3>Arquivos encontrados:</h3>";
foreach ($paths_to_check as $path) {
    $full_path = $base_path . '/' . $path;
    if (file_exists($full_path)) {
        echo "✅ " . $path . "<br>";
    } else {
        echo "❌ " . $path . " - NÃO ENCONTRADO<br>";
    }
}

// Teste de autoloader
echo "<h2>Testando Autoloader:</h2>";
spl_autoload_register(function ($class) use ($base_path) {
    $paths = [
        '/controllers/',
        '/models/',
        '/services/',
        '/config/'
    ];
    
    foreach ($paths as $path) {
        $file = $base_path . $path . $class . '.php';
        echo "Tentando: " . $file . "<br>";
        if (file_exists($file)) {
            require_once $file;
            echo "✅ Carregado: " . $class . "<br>";
            return;
        }
    }
    echo "❌ Não encontrado: " . $class . "<br>";
});

// Teste das classes
echo "<h2>Testando Classes:</h2>";
try {
    echo "Testando Database...<br>";
    $db = new Database();
    echo "✅ Database OK<br>";
    
    echo "Testando IdeiaController...<br>";  
    $controller = new IdeiaController();
    echo "✅ IdeiaController OK<br>";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}

echo "<h2>Redirecionando para o sistema em 5 segundos...</h2>";
echo "<script>setTimeout(() => { window.location.href = 'index.php'; }, 5000);</script>";
?>