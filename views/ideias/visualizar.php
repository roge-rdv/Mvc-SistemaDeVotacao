<?php 
$titulo = htmlspecialchars($ideia['titulo']) . ' - Sistema de Votação';
ob_start(); 
?>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1"><?php echo htmlspecialchars($ideia['titulo']); ?></h4>
                    <small class="text-muted">
                        Por <strong><?php echo htmlspecialchars($ideia['autor_nome']); ?></strong> 
                        em <?php echo date('d/m/Y H:i', strtotime($ideia['data_criacao'])); ?>
                    </small>
                </div>
                
                <?php if ($usuario_logado && $usuario_logado['id'] == $ideia['usuario_id']): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Opções
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controller=ideia&action=editar&id=<?php echo $ideia['id']; ?>">Editar</a></li>
                            <li><a class="dropdown-item text-danger" href="index.php?controller=ideia&action=excluir&id=<?php echo $ideia['id']; ?>">Excluir</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="card-body">
                <div class="mb-4">
                    <?php echo nl2br(htmlspecialchars($ideia['descricao'])); ?>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <?php if ($usuario_logado && $usuario_logado['id'] != $ideia['usuario_id']): ?>
                            <form class="voto-form d-inline" data-ideia-id="<?php echo $ideia['id']; ?>">
                                <button type="submit" class="btn btn-<?php echo $ideia['usuario_ja_votou'] ? 'danger' : 'outline-danger'; ?>">
                                    <?php echo $ideia['usuario_ja_votou'] ? '❤️ Remover Voto' : '🤍 Votar nesta Ideia'; ?>
                                </button>
                            </form>
                        <?php elseif (!$usuario_logado): ?>
                            <a href="index.php?controller=usuario&action=login" class="btn btn-outline-primary">
                                Faça login para votar
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Esta é sua ideia</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="text-center">
                        <h5 class="text-primary mb-0 total-votos"><?php echo $ideia['total_votos']; ?></h5>
                        <small class="text-muted">votos</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="index.php" class="btn btn-outline-secondary">← Voltar para Home</a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">👥 Quem Votou (<?php echo count($ideia['votantes']); ?>)</h6>
            </div>
            <div class="card-body">
                <?php if (empty($ideia['votantes'])): ?>
                    <p class="text-muted small">Ainda não há votos para esta ideia.</p>
                <?php else: ?>
                    <?php foreach ($ideia['votantes'] as $votante): ?>
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-2">👤</div>
                            <div class="flex-grow-1">
                                <strong><?php echo htmlspecialchars($votante['usuario_nome']); ?></strong><br>
                                <small class="text-muted">
                                    Votou em <?php echo date('d/m/Y', strtotime($votante['data_voto'])); ?>
                                </small>
                            </div>
                        </div>
                        <?php if ($votante !== end($ideia['votantes'])): ?>
                            <hr class="my-2">
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">📊 Estatísticas</h6>
            </div>
            <div class="card-body">
                <p><strong>Total de Votos:</strong> <?php echo $ideia['total_votos']; ?></p>
                <p><strong>Criada em:</strong> <?php echo date('d/m/Y H:i', strtotime($ideia['data_criacao'])); ?></p>
                <p><strong>Autor:</strong> <?php echo htmlspecialchars($ideia['autor_nome']); ?></p>
            </div>
        </div>
    </div>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>