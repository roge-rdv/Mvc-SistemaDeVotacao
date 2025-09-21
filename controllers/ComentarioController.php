<?php
require_once __DIR__ . '/../services/ComentarioService.php';
require_once __DIR__ . '/../config.php';

class ComentarioController {
    private $comentarioService;

    public function __construct($pdo) {
        $this->comentarioService = new ComentarioService($pdo);
    }

    // Listar comentários de uma ideia
    public function listar($ideiaId) {
        return $this->comentarioService->listarPorIdeia($ideiaId);
    }

    // Criar novo comentário
    public function criar($ideiaId, $usuarioId, $texto) {
        return $this->comentarioService->criar($ideiaId, $usuarioId, $texto);
    }

    // Deletar comentário
    public function deletar($id) {
        return $this->comentarioService->deletar($id);
    }
}
