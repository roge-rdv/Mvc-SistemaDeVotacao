<?php 
$titulo = 'Meu Perfil - Sistema de Votação';
ob_start(); 
?>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">👤 Meu Perfil</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informações Pessoais</h6>
                        <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                        <p><strong>Membro desde:</strong> <?php echo date('d/m/Y', strtotime($usuario['data_criacao'])); ?></p>
                        
                        <a href="index.php?controller=usuario&action=editar" class="btn btn-primary">
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">📊 Minhas Atividades</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="index.php?controller=usuario&action=minhasIdeias" class="btn btn-outline-primary btn-sm w-100">
                        💡 Minhas Ideias
                    </a>
                </div>
                <div class="mb-3">
                    <a href="index.php?controller=usuario&action=meusVotos" class="btn btn-outline-danger btn-sm w-100">
                        ❤️ Meus Votos
                    </a>
                </div>
                <hr>
                <div class="text-center">
                    <a href="index.php?controller=ideia&action=criar" class="btn btn-success btn-sm">
                        ➕ Nova Ideia
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$conteudo = ob_get_clean();
include '../views/layout.php'; 
?>