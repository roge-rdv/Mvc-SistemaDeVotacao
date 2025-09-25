<?php 
$titulo = 'Cadastro - Sistema de Votação';
ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h4 class="mb-0">📝 Cadastro</h4>
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

                <form method="POST" action="index.php?controller=usuario&action=cadastrar">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo *</label>
                        <input type="text" 
                               class="form-control" 
                               id="nome" 
                               name="nome" 
                               value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha *</label>
                        <input type="password" 
                               class="form-control" 
                               id="senha" 
                               name="senha" 
                               required>
                        <div class="form-text">Mínimo de 6 caracteres</div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar Senha *</label>
                        <input type="password" 
                               class="form-control" 
                               id="confirmar_senha" 
                               name="confirmar_senha" 
                               required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Criar Conta</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0">Já tem conta? 
                    <a href="index.php?controller=usuario&action=login">Faça login aqui</a>
                </p>
            </div>
        </div>

        <div class="mt-3 text-center">
            <a href="index.php" class="btn btn-outline-secondary">← Voltar para Home</a>
        </div>
    </div>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>