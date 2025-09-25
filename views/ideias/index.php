<?php 
$titulo = 'Sistema de Votação de Ideias';
ob_start(); 
?>

<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>💡 Ideias Compartilhadas</h1>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="index.php?controller=ideia&action=criar" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Nova Ideia
                </a>
            <?php endif; ?>
        </div>

        <?php if (empty($ideias)): ?>
            <div class="text-center py-5">
                <h3 class="text-muted">Nenhuma ideia foi compartilhada ainda</h3>
                <p class="text-muted">Seja o primeiro a compartilhar uma ideia incrível!</p>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="index.php?controller=ideia&action=criar" class="btn btn-primary">Criar Primeira Ideia</a>
                <?php else: ?>
                    <a href="index.php?controller=usuario&action=cadastrar" class="btn btn-primary">Cadastre-se para Participar</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php foreach ($ideias as $ideia): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
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
                                    Por <strong><?php echo htmlspecialchars($ideia['autor_nome']); ?></strong> 
                                    em <?php echo date('d/m/Y H:i', strtotime($ideia['data_criacao'])); ?>
                                </small>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <?php if (isset($_SESSION['usuario_id']) && $ideia['usuario_id'] != $_SESSION['usuario_id']): ?>
                                        <form class="voto-form mb-2" data-ideia-id="<?php echo $ideia['id']; ?>">
                                            <button type="submit" class="btn btn-<?php echo $ideia['usuario_ja_votou'] ? 'danger' : 'outline-danger'; ?> btn-sm">
                                                <?php echo $ideia['usuario_ja_votou'] ? '❤️' : '🤍'; ?>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <span class="badge bg-primary total-votos"><?php echo $ideia['total_votos']; ?></span>
                                    <small class="text-muted">votos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">📊 Estatísticas</h6>
            </div>
            <div class="card-body">
                <p><strong>Total de Ideias:</strong> <?php echo count($ideias); ?></p>
                <p><strong>Total de Votos:</strong> <?php echo array_sum(array_column($ideias, 'total_votos')); ?></p>
                
                <?php if (!empty($ideias)): ?>
                    <hr>
                    <h6>🏆 Ideia Mais Votada:</h6>
                    <?php $maisVotada = $ideias[0]; ?>
                    <div class="small">
                        <strong><?php echo htmlspecialchars($maisVotada['titulo']); ?></strong><br>
                        <span class="text-muted">
                            <?php echo $maisVotada['total_votos']; ?> votos - 
                            por <?php echo htmlspecialchars($maisVotada['autor_nome']); ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if (!isset($_SESSION['usuario_id'])): ?>
            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">🚀 Participe!</h6>
                </div>
                <div class="card-body">
                    <p class="small">Compartilhe suas ideias e vote nas melhores!</p>
                    <a href="index.php?controller=usuario&action=cadastrar" class="btn btn-success btn-sm">Cadastrar</a>
                    <a href="index.php?controller=usuario&action=login" class="btn btn-outline-success btn-sm">Login</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>