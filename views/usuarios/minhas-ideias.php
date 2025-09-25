<?php 
$titulo = 'Minhas Ideias - Sistema de Votação';
ob_start(); 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>💡 Minhas Ideias</h2>
    <a href="index.php?controller=ideia&action=criar" class="btn btn-success">
        ➕ Nova Ideia
    </a>
</div>

<?php if (empty($ideias)): ?>
    <div class="text-center py-5">
        <h4 class="text-muted">Você ainda não compartilhou nenhuma ideia</h4>
        <p class="text-muted">Que tal começar compartilhando sua primeira ideia?</p>
        <a href="index.php?controller=ideia&action=criar" class="btn btn-success">Criar Primeira Ideia</a>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-8">
            <?php foreach ($ideias as $ideia): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title">
                                    <a href="index.php?controller=ideia&action=visualizar&id=<?php echo $ideia['id']; ?>" 
                                       class="text-decoration-none">
                                        <?php echo htmlspecialchars($ideia['titulo']); ?>
                                    </a>
                                </h5>
                                <p class="card-text text-muted">
                                    <?php echo htmlspecialchars(substr($ideia['descricao'], 0, 150)) . (strlen($ideia['descricao']) > 150 ? '...' : ''); ?>
                                </p>
                                <small class="text-muted">
                                    Criada em <?php echo date('d/m/Y H:i', strtotime($ideia['data_criacao'])); ?>
                                    • <?php echo $ideia['total_votos']; ?> voto(s)
                                </small>
                            </div>
                            <div class="dropdown ms-3">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Opções
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="index.php?controller=ideia&action=visualizar&id=<?php echo $ideia['id']; ?>">
                                            👁️ Visualizar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="index.php?controller=ideia&action=editar&id=<?php echo $ideia['id']; ?>">
                                            ✏️ Editar
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="index.php?controller=ideia&action=excluir&id=<?php echo $ideia['id']; ?>">
                                            🗑️ Excluir
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">📈 Estatísticas</h6>
                </div>
                <div class="card-body">
                    <p><strong>Total de Ideias:</strong> <?php echo count($ideias); ?></p>
                    <p><strong>Total de Votos Recebidos:</strong> <?php echo array_sum(array_column($ideias, 'total_votos')); ?></p>
                    
                    <?php if (!empty($ideias)): ?>
                        <?php 
                        $maisVotada = array_reduce($ideias, function($max, $ideia) {
                            return ($ideia['total_votos'] > $max['total_votos']) ? $ideia : $max;
                        }, $ideias[0]);
                        ?>
                        <hr>
                        <h6>🏆 Sua Ideia Mais Votada:</h6>
                        <div class="small">
                            <strong><?php echo htmlspecialchars(substr($maisVotada['titulo'], 0, 40)) . (strlen($maisVotada['titulo']) > 40 ? '...' : ''); ?></strong><br>
                            <span class="text-muted"><?php echo $maisVotada['total_votos']; ?> votos</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="mt-3">
    <a href="index.php?controller=usuario&action=perfil" class="btn btn-outline-secondary">← Voltar ao Perfil</a>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>