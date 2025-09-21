<?php

namespace Daos;

use PDO;
use Models\Ideia;

// Inclui a configuração do banco de dados uma única vez.
require_once __DIR__ . '/../config.php';

class IdeiaDAO
{
    private $pdo;

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Em um projeto real, faríamos o log do erro.
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Busca todas as ideias no banco de dados com o nome do usuário.
     * @return Ideia[]
     */
    public function getAll()
    {
        $sql = "SELECT i.*, u.nome as nome_usuario 
                FROM ideias i 
                JOIN usuarios u ON i.usuario_id = u.id 
                ORDER BY i.id DESC";
        $stmt = $this->pdo->query($sql);
        // Mapeia o resultado para um array de objetos da classe Ideia.
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Models\Ideia');
    }

    /**
     * Busca uma ideia específica pelo seu ID.
     * @param int $id O ID da ideia.
     * @return Ideia|false
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM ideias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Define o modo de fetch para a classe Ideia.
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Ideia');
        return $stmt->fetch();
    }

    /**
     * Salva uma nova ideia no banco de dados.
     * @param Ideia $ideia O objeto Ideia a ser salvo.
     * @return bool
     */
    public function create(Ideia $ideia)
    {
        $sql = "INSERT INTO ideias (titulo, descricao, usuario_id) VALUES (:titulo, :descricao, :usuario_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':titulo', $ideia->titulo);
        $stmt->bindValue(':descricao', $ideia->descricao);
        $stmt->bindValue(':usuario_id', $ideia->usuario_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Atualiza uma ideia existente no banco de dados.
     * @param Ideia $ideia O objeto Ideia com os dados atualizados.
     * @return bool
     */
    public function update(Ideia $ideia)
    {
        $sql = "UPDATE ideias SET titulo = :titulo, descricao = :descricao WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':titulo', $ideia->titulo);
        $stmt->bindValue(':descricao', $ideia->descricao);
        $stmt->bindValue(':id', $ideia->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Deleta uma ideia do banco de dados pelo seu ID.
     * @param int $id O ID da ideia a ser deletada.
     * @return bool
     */
    public function delete($id)
    {
        $sql = "DELETE FROM ideias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
