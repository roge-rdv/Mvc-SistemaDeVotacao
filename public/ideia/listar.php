<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>📋 Lista de Ideias</h2>
    <a href="?param=ideia/formulario" class="btn">💡 Nova Ideia</a>
</div>

<?php if (empty($parametro)): ?>
    <div style="text-align: center; padding: 40px; color: #666;">
        <h3>Nenhuma ideia cadastrada ainda</h3>
        <p>Seja o primeiro a compartilhar uma ideia!</p>
        <a href="?param=ideia/formulario" class="btn">💡 Cadastrar Primera Ideia</a>
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Usuário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parametro as $ideia): ?>
                <tr>
                    <td><?= $ideia["id"] ?></td>
                    <td><strong><?= htmlspecialchars($ideia["titulo"]) ?></strong></td>
                    <td><?= htmlspecialchars($ideia["descricao"]) ?></td>
                    <td>Usuário #<?= $ideia["usuario_id"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>