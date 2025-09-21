<?php

require_once __DIR__ . '/../models/Comentario.php';
use Models\Comentario;

class ComentarioDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Buscar todos os comentários de uma ideia
    public function buscarPorIdeia($ideiaId) {
        $sql = "SELECT c.*, u.nome AS nome_usuario FROM comentarios c JOIN usuarios u ON c.usuario_id = u.id WHERE c.ideia_id = :ideia_id ORDER BY c.criado_em ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':ideia_id', $ideiaId, PDO::PARAM_INT);
        $stmt->execute();
        $comentarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comentario = new Comentario();
            $comentario->id = $row['id'];
            $comentario->ideia_id = $row['ideia_id'];
            $comentario->usuario_id = $row['usuario_id'];
            $comentario->texto = $row['texto'];
            $comentario->criado_em = $row['criado_em'];
            $comentario->nome_usuario = $row['nome_usuario'];
            $comentarios[] = $comentario;
        }
        return $comentarios;
    }

    // Criar novo comentário
    public function criar($ideiaId, $usuarioId, $texto) {
        $sql = "INSERT INTO comentarios (ideia_id, usuario_id, texto) VALUES (:ideia_id, :usuario_id, :texto)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':ideia_id', $ideiaId, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Deletar comentário
    public function deletar($id) {
        $sql = "DELETE FROM comentarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
