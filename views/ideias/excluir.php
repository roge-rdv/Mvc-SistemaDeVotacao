<?php 
$titulo = 'Excluir Ideia - Sistema de Votação';
ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">🗑️ Confirmar Exclusão</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <strong>Atenção!</strong> Esta ação não pode ser desfeita.
                </div>

                <h5>Tem certeza que deseja excluir esta ideia?</h5>
                
                <div class="border p-3 rounded bg-light mb-4">
                    <h6><strong><?php echo htmlspecialchars($ideia['titulo']); ?></strong></h6>
                    <p class="text-muted mb-2">
                        <?php echo htmlspecialchars(substr($ideia['descricao'], 0, 200)) . (strlen($ideia['descricao']) > 200 ? '...' : ''); ?>
                    </p>
                    <small class="text-muted">
                        Criada em <?php echo date('d/m/Y H:i', strtotime($ideia['data_criacao'])); ?>
                        • <?php echo $ideia['total_votos']; ?> voto(s) recebido(s)
                    </small>
                </div>

                <?php if ($ideia['total_votos'] > 0): ?>
                    <div class="alert alert-info">
                        <strong>Importante:</strong> Esta ideia já recebeu <?php echo $ideia['total_votos']; ?> voto(s). 
                        Ao excluí-la, todos os votos também serão removidos.
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?controller=ideia&action=excluir&id=<?php echo $ideia['id']; ?>">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?controller=ideia&action=visualizar&id=<?php echo $ideia['id']; ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-danger">Sim, Excluir Ideia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>