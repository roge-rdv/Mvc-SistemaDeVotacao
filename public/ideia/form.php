<h2>💡 Nova Ideia</h2>
<p>Compartilhe sua ideia com a comunidade!</p>

<form method="POST" action="?param=ideia/inserir">
    <div class="form-group">
        <label>Título da Ideia:</label>
        <input type="text" name="titulo" required placeholder="Digite o título da sua ideia..." />
    </div>
    
    <div class="form-group">
        <label>Descrição:</label>
        <textarea name="descricao" required placeholder="Descreva sua ideia em detalhes..."></textarea>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <input type="submit" value="✨ Cadastrar Ideia" class="submit-btn" />
        <a href="?param=ideia/lista" class="btn">📋 Voltar para Lista</a>
    </div>
</form>