<?php
require_once __DIR__ . '/../models/Voto.php';
use Models\Voto;

class VotoDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Adiciona um voto
    public function votar($usuarioId, $ideiaId) {
        $sql = "INSERT INTO votos (usuario_id, ideia_id) VALUES (:usuario_id, :ideia_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':ideia_id', $ideiaId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Remove um voto
    public function desvotar($usuarioId, $ideiaId) {
        $sql = "DELETE FROM votos WHERE usuario_id = :usuario_id AND ideia_id = :ideia_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':ideia_id', $ideiaId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Verifica se o usuário já votou na ideia
    public function jaVotou($usuarioId, $ideiaId) {
        $sql = "SELECT id FROM votos WHERE usuario_id = :usuario_id AND ideia_id = :ideia_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':ideia_id', $ideiaId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Conta votos de uma ideia
    public function contarVotos($ideiaId) {
        $sql = "SELECT COUNT(*) as total FROM votos WHERE ideia_id = :ideia_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':ideia_id', $ideiaId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }
}
