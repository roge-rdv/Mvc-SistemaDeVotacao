<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Votação de Ideias</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1, h2 { color: #5a2d82; }
        .form-container, .ideia-card { background: #fdfdff; border: 1px solid #eee; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #5a2d82; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #4a1f6e; }
        hr { border: 0; height: 1px; background: #ddd; margin: 20px 0; }
        small { color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Votação de Ideias</h1>
        
        <div class="form-container">
            <?php require __DIR__ . '/../../templates/formulario.php'; ?>
        </div>

        <hr>

        <h2>Ideias Recentes</h2>
        <div class="ideias-lista">
            <?php if (empty($ideias)): ?>
                <p>Nenhuma ideia foi sugerida ainda. Seja o primeiro!</p>
            <?php else: ?>
                <?php foreach ($ideias as $ideia): ?>
                    <div class="ideia-card">
                        <h3><?php echo htmlspecialchars($ideia->titulo); ?></h3>
                        <p><?php echo htmlspecialchars($ideia->descricao); ?></p>
                        <small>Enviada pelo Usuário ID: <?php echo $ideia->usuario_id; ?></small>
                        <br>
                        <a href="<?php echo BASE_URL . '/ideia/editar/' . $ideia->id; ?>">
                            <button type="button">Editar</button>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

