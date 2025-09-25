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
                        <?php
                        // Votação
                        require_once __DIR__ . '/../../config.php';
                        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
                        require_once __DIR__ . '/../../controllers/VotoController.php';
                        $votoController = new VotoController($pdo);
                        $usuarioId = 1; // Troque pelo usuário logado
                        $jaVotou = $votoController->jaVotou($usuarioId, $ideia->id);
                        $totalVotos = $votoController->contarVotos($ideia->id);
                        ?>
                        <form method="POST" action="<?php echo BASE_URL . ($jaVotou ? '/voto/desvotar' : '/voto/votar'); ?>" style="display:inline;">
                            <input type="hidden" name="ideia_id" value="<?php echo $ideia->id; ?>">
                            <input type="hidden" name="usuario_id" value="<?php echo $usuarioId; ?>">
                            <button type="submit" style="background:<?php echo $jaVotou ? '#aaa' : '#5a2d82'; ?>;color:white;padding:6px 12px;border:none;border-radius:4px;">
                                <?php echo $jaVotou ? 'Desvotar' : 'Votar'; ?>
                            </button>
                        </form>
                        <span style="margin-left:10px;color:#5a2d82;font-weight:bold;">Votos: <?php echo $totalVotos; ?></span>
                        <?php
                        // session_start(); // Removido: sessão já iniciada em index.php
                        $usuarioLogadoId = $_SESSION['usuario_id'] ?? null;
                        $isAdmin = $_SESSION['is_admin'] ?? 0;
                        if ($usuarioLogadoId == $ideia->usuario_id || $isAdmin) {
                        ?>
                        <a href="<?php echo BASE_URL . '/ideia/editar/' . $ideia->id; ?>">
                            <button type="button">Editar</button>
                        </a>
                        <form method="POST" action="<?php echo BASE_URL . '/ideia/excluir/' . $ideia->id; ?>" style="display:inline;">
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta ideia?');" style="background:#c0392b;margin-left:8px;">Excluir</button>
                        </form>
                        <?php } ?>
                        <!-- Comentários -->
                        <div class="comentarios" style="margin-top:20px;">
                            <h4 style="color:#5a2d82;">Comentários</h4>
                            <?php
                            // Buscar comentários para a ideia
                            require_once __DIR__ . '/../../controllers/ComentarioController.php';
                            require_once __DIR__ . '/../../config.php';
                            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
                            $comentarioController = new ComentarioController($pdo);
                            $comentarios = $comentarioController->listar($ideia->id);
                            ?>
                            <div>
                                <?php if (empty($comentarios)): ?>
                                    <p style="color:#777;">Nenhum comentário ainda.</p>
                                <?php else: ?>
                                    <?php foreach ($comentarios as $comentario): ?>
                                        <div style="background:#f7f7fa; border-radius:4px; padding:8px; margin-bottom:6px;">
                                            <strong><?php echo htmlspecialchars($comentario->nome_usuario ?? 'Usuário'); ?>:</strong>
                                            <span><?php echo htmlspecialchars($comentario->texto); ?></span>
                                            <small style="color:#aaa; float:right;"><?php echo date('d/m/Y H:i', strtotime($comentario->criado_em)); ?></small>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Formulário de novo comentário -->
                            <form method="POST" action="<?php echo BASE_URL . '/comentario/criar'; ?>" style="margin-top:10px;">
                                <input type="hidden" name="ideia_id" value="<?php echo $ideia->id; ?>">
                                <input type="hidden" name="usuario_id" value="1"><!-- Troque pelo ID do usuário logado -->
                                <textarea name="texto" rows="2" placeholder="Escreva um comentário..." required style="width:95%;padding:8px;border-radius:4px;border:1px solid #ccc;"></textarea>
                                <button type="submit" style="margin-top:5px;background:#5a2d82;color:white;padding:6px 12px;border:none;border-radius:4px;">Comentar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

