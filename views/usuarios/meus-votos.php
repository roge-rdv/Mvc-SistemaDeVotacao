<?php 
$titulo = 'Meus Votos - Sistema de Votação';
ob_start(); 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>❤️ Meus Votos</h2>
    <a href="index.php" class="btn btn-primary">
        🔍 Descobrir Mais Ideias
    </a>
</div>

<?php if (empty($votos)): ?>
    <div class="text-center py-5">
        <h4 class="text-muted">Você ainda não votou em nenhuma ideia</h4>
        <p class="text-muted">Explore as ideias compartilhadas pela comunidade e vote nas suas favoritas!</p>
        <a href="index.php" class="btn btn-primary">Ver Ideias Disponíveis</a>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-8">
            <?php foreach ($votos as $voto): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title">
                                    <a href="index.php?controller=ideia&action=visualizar&id=<?php echo $voto['ideia_id']; ?>" 
                                       class="text-decoration-none">
                                        <?php echo htmlspecialchars($voto['ideia_titulo']); ?>
                                    </a>
                                </h5>
                                <p class="card-text text-muted">
                                    <?php echo htmlspecialchars(substr($voto['ideia_descricao'], 0, 150)) . (strlen($voto['ideia_descricao']) > 150 ? '...' : ''); ?>
                                </p>
                                <small class="text-muted">
                                    Você votou em <?php echo date('d/m/Y H:i', strtotime($voto['data_voto'])); ?>
                                </small>
                            </div>
                            <div class="ms-3">
                                <span class="badge bg-danger">❤️ Votado</span>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <form class="voto-form d-inline" data-ideia-id="<?php echo $voto['ideia_id']; ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Remover Voto
                                </button>
                            </form>
                            <a href="index.php?controller=ideia&action=visualizar&id=<?php echo $voto['ideia_id']; ?>" 
                               class="btn btn-outline-primary btn-sm">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0">📊 Estatísticas dos Votos</h6>
                </div>
                <div class="card-body">
                    <p><strong>Total de Votos Dados:</strong> <?php echo count($votos); ?></p>
                    
                    <?php if (!empty($votos)): ?>
                        <hr>
                        <h6>🗓️ Último Voto:</h6>
                        <?php $ultimoVoto = $votos[0]; ?>
                        <div class="small">
                            <strong><?php echo htmlspecialchars(substr($ultimoVoto['ideia_titulo'], 0, 40)) . (strlen($ultimoVoto['ideia_titulo']) > 40 ? '...' : ''); ?></strong><br>
                            <span class="text-muted">
                                em <?php echo date('d/m/Y', strtotime($ultimoVoto['data_voto'])); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">💡 Dica</h6>
                </div>
                <div class="card-body">
                    <p class="small mb-0">
                        Você pode remover seus votos a qualquer momento clicando em "Remover Voto" 
                        ou votando novamente na ideia.
                    </p>
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