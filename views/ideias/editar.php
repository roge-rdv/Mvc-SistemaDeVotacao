<?php 
$titulo = 'Editar Ideia - Sistema de Votação';
ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Ideia</h4>
            </div>
            <div class="card-body">
                <?php if (isset($erros) && !empty($erros)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($erros as $erro): ?>
                                <li><?php echo htmlspecialchars($erro); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?controller=ideia&action=editar&id=<?php echo $ideia['id']; ?>">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título da Ideia *</label>
                        <input type="text" 
                               class="form-control" 
                               id="titulo" 
                               name="titulo" 
                               maxlength="150"
                               value="<?php echo htmlspecialchars($_POST['titulo'] ?? $ideia['titulo']); ?>" 
                               required>
                        <div class="form-text">Máximo de 150 caracteres</div>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição Completa *</label>
                        <textarea class="form-control" 
                                  id="descricao" 
                                  name="descricao" 
                                  rows="6" 
                                  required><?php echo htmlspecialchars($_POST['descricao'] ?? $ideia['descricao']); ?></textarea>
                        <div class="form-text">Mínimo de 10 caracteres</div>
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <strong>Nota:</strong> Esta ideia já recebeu <?php echo $ideia['total_votos']; ?> voto(s). 
                            As alterações não afetarão os votos já recebidos.
                        </small>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?controller=ideia&action=visualizar&id=<?php echo $ideia['id']; ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
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