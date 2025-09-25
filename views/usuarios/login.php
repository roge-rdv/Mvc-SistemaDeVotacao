<?php 
$titulo = 'Login - Sistema de Votação';
ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">🔐 Login</h4>
            </div>
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($erro); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?controller=usuario&action=login">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" 
                               class="form-control" 
                               id="senha" 
                               name="senha" 
                               required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0">Não tem conta? 
                    <a href="index.php?controller=usuario&action=cadastrar">Cadastre-se aqui</a>
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