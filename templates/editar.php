<?php
// Template do formulário de edição de ideia
?>

<form action="<?php echo BASE_URL . '/ideia/atualizar/' . $ideia->id; ?>" method="POST" class="space-y-6">
    <div>
        <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título da Ideia</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($ideia->titulo); ?>" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-900">
    </div>
    <div>
        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
        <textarea id="descricao" name="descricao" rows="5" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-900"><?php echo htmlspecialchars($ideia->descricao); ?></textarea>
    </div>
    <div class="flex items-center justify-end gap-4">
        <a href="<?php echo BASE_URL; ?>" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">Cancelar</a>
        <button type="submit" class="px-6 py-2 rounded-lg bg-purple-600 text-white font-semibold hover:bg-purple-700 transition">Salvar Alterações</button>
    </div>
</form>
