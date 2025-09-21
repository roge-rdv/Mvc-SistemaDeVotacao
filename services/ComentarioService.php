<?php

require_once __DIR__ . '/../daos/ComentarioDAO.php';

class ComentarioService {
    private $comentarioDAO;

    public function __construct($pdo) {
        $this->comentarioDAO = new ComentarioDAO($pdo);
    }

    public function listarPorIdeia($ideiaId) {
        return $this->comentarioDAO->buscarPorIdeia($ideiaId);
    }

    public function criar($ideiaId, $usuarioId, $texto) {
        return $this->comentarioDAO->criar($ideiaId, $usuarioId, $texto);
    }

    public function deletar($id) {
        return $this->comentarioDAO->deletar($id);
    }
}
