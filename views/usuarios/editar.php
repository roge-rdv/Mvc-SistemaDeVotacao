<?php 
$titulo = 'Editar Perfil - Sistema de Votação';
ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Perfil</h4>
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

                <form method="POST" action="index.php?controller=usuario&action=editar&id=<?php echo $usuario['id']; ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo *</label>
                        <input type="text" 
                               class="form-control" 
                               id="nome" 
                               name="nome" 
                               value="<?php echo htmlspecialchars($_POST['nome'] ?? $usuario['nome']); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="<?php echo htmlspecialchars($_POST['email'] ?? $usuario['email']); ?>" 
                               required>
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <strong>Nota:</strong> Para alterar sua senha, entre em contato com o administrador do sistema.
                        </small>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?controller=usuario&action=perfil" class="btn btn-secondary">Cancelar</a>
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