<?php
// Template do formulário de criação de ideia
?>
<form method="POST" action="<?php echo BASE_URL; ?>/ideia/criar">
    <h2>Nova Ideia</h2>
    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao" rows="3" required></textarea>
    </div>
    <button type="submit">Enviar Ideia</button>
</form>
