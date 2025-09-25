<?php

class VotoDAO {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function votar($usuario_id, $ideia_id) {
        $query = "INSERT INTO votos (usuario_id, ideia_id) VALUES (:usuario_id, :ideia_id)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':ideia_id', $ideia_id);
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // Se der erro de chave duplicada, significa que o usuário já votou
            if ($e->getCode() == 23000) {
                return false;
            }
            throw $e;
        }
    }
    
    public function removerVoto($usuario_id, $ideia_id) {
        $query = "DELETE FROM votos WHERE usuario_id = :usuario_id AND ideia_id = :ideia_id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':ideia_id', $ideia_id);
        
        return $stmt->execute();
    }
    
    public function verificarVoto($usuario_id, $ideia_id) {
        $query = "SELECT id FROM votos WHERE usuario_id = :usuario_id AND ideia_id = :ideia_id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':ideia_id', $ideia_id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
    
    public function contarVotosPorIdeia($ideia_id) {
        $query = "SELECT COUNT(*) as total FROM votos WHERE ideia_id = :ideia_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ideia_id', $ideia_id);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function listarVotosDoUsuario($usuario_id) {
        $query = "SELECT v.*, i.titulo as ideia_titulo, i.descricao as ideia_descricao
                  FROM votos v 
                  JOIN ideias i ON v.ideia_id = i.id 
                  WHERE v.usuario_id = :usuario_id 
                  ORDER BY v.data_voto DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function listarVotantesDeIdeia($ideia_id) {
        $query = "SELECT v.*, u.nome as usuario_nome, u.email as usuario_email
                  FROM votos v 
                  JOIN usuarios u ON v.usuario_id = u.id 
                  WHERE v.ideia_id = :ideia_id 
                  ORDER BY v.data_voto DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ideia_id', $ideia_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>