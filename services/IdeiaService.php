<?php
require_once __DIR__ . '/../models/Ideia.php';
use Models\Ideia;

class IdeiaService
{
    private $pdo;

    /**
     * Exclui uma ideia do banco de dados.
     * @param int $id ID da ideia
     * @return bool
     */
    public function excluirIdeia($id)
    {
        try {
            $sql = "DELETE FROM ideias WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao excluir a ideia: " . $e->getMessage());
            return false;
        }
    }

    public function __construct()
    {
        // Inclui a configuração e estabelece a conexão PDO
        // Usar require_once para evitar que as constantes sejam definidas múltiplas vezes
        require_once __DIR__ . '/../config.php';
        try {
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USER,
                DB_PASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Busca todas as ideias no banco de dados.
     * @return Ideia[]
     */
    public function buscarTodas()
    {
        $sql = "SELECT * FROM ideias ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);

        $ideias = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ideia = new Ideia();
            $ideia->id = $row['id'];
            $ideia->titulo = $row['titulo'];
            $ideia->descricao = $row['descricao'];
            $ideia->usuario_id = $row['usuario_id'];
            $ideias[] = $ideia;
        }

        return $ideias;
    }
    
    /**
     * Cria uma nova ideia no banco de dados.
     * @param string $titulo O título da ideia.
     * @param string $descricao A descrição da ideia.
     * @param int $usuarioId O ID do usuário que criou a ideia.
     * @return bool Retorna true em caso de sucesso, false em caso de falha.
     */
    public function criarIdeia($titulo, $descricao, $usuarioId)
    {
        try {
            $sql = "INSERT INTO ideias (titulo, descricao, usuario_id) VALUES (:titulo, :descricao, :usuario_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Em um aplicativo real, você faria o log do erro em vez de usar die()
            die("Erro ao criar a ideia: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Atualiza uma ideia existente no banco de dados.
     * @param int $id ID da ideia
     * @param string $titulo Novo título
     * @param string $descricao Nova descrição
     * @param int $usuarioId ID do usuário
     * @return bool
     */
    public function atualizarIdeia($id, $titulo, $descricao, $usuarioId)
    {
        try {
            $sql = "UPDATE ideias SET titulo = :titulo, descricao = :descricao, usuario_id = :usuario_id WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Erro ao atualizar a ideia: " . $e->getMessage());
            return false;
        }
    }
}

