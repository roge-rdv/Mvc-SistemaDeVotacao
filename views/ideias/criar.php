<?php 
$titulo = 'Nova Ideia - Sistema de Votação';
ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">💡 Compartilhar Nova Ideia</h4>
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

                <form method="POST" action="index.php?controller=ideia&action=criar">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título da Ideia *</label>
                        <input type="text" 
                               class="form-control" 
                               id="titulo" 
                               name="titulo" 
                               maxlength="150"
                               value="<?php echo htmlspecialchars($_POST['titulo'] ?? ''); ?>" 
                               required>
                        <div class="form-text">Máximo de 150 caracteres</div>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição Completa *</label>
                        <textarea class="form-control" 
                                  id="descricao" 
                                  name="descricao" 
                                  rows="6" 
                                  placeholder="Descreva sua ideia de forma detalhada. Explique o problema que ela resolve, como funcionaria, quais benefícios traria..."
                                  required><?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?></textarea>
                        <div class="form-text">Mínimo de 10 caracteres</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Compartilhar Ideia</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 p-3 bg-light rounded">
            <h6>💡 Dicas para uma boa ideia:</h6>
            <ul class="small mb-0">
                <li>Seja claro e objetivo no título</li>
                <li>Explique detalhadamente como sua ideia funcionaria</li>
                <li>Descreva que problema ela resolve</li>
                <li>Mencione os benefícios que traria</li>
                <li>Seja criativo e inovador!</li>
            </ul>
        </div>
    </div>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>