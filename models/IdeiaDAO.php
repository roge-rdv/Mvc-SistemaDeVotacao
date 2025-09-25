<?php

class IdeiaDAO {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function criar($titulo, $descricao, $usuario_id) {
        $query = "INSERT INTO ideias (titulo, descricao, usuario_id) VALUES (:titulo, :descricao, :usuario_id)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':usuario_id', $usuario_id);
        
        return $stmt->execute();
    }
    
    public function listarTodas() {
        $query = "SELECT i.*, u.nome as autor_nome, 
                         (SELECT COUNT(*) FROM votos v WHERE v.ideia_id = i.id) as total_votos
                  FROM ideias i 
                  JOIN usuarios u ON i.usuario_id = u.id 
                  ORDER BY total_votos DESC, i.data_criacao DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarPorId($id) {
        $query = "SELECT i.*, u.nome as autor_nome, 
                         (SELECT COUNT(*) FROM votos v WHERE v.ideia_id = i.id) as total_votos
                  FROM ideias i 
                  JOIN usuarios u ON i.usuario_id = u.id 
                  WHERE i.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function listarPorUsuario($usuario_id) {
        $query = "SELECT i.*, u.nome as autor_nome, 
                         (SELECT COUNT(*) FROM votos v WHERE v.ideia_id = i.id) as total_votos
                  FROM ideias i 
                  JOIN usuarios u ON i.usuario_id = u.id 
                  WHERE i.usuario_id = :usuario_id 
                  ORDER BY i.data_criacao DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function atualizar($id, $titulo, $descricao) {
        $query = "UPDATE ideias SET titulo = :titulo, descricao = :descricao WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        
        return $stmt->execute();
    }
    
    public function excluir($id) {
        $query = "DELETE FROM ideias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    public function verificarProprietario($id, $usuario_id) {
        $query = "SELECT id FROM ideias WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
}
?>