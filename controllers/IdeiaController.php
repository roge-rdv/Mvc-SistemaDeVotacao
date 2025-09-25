
<?php
require_once __DIR__ . '/../services/IdeiaService.php';

class IdeiaController
{
    private $ideiaService;

    public function __construct()
    {
    $this->ideiaService = new IdeiaService();
    }

    public function listar()
    {
        $ideias = $this->ideiaService->buscarTodas();
        require __DIR__ . '/../views/ideia/listar.php';
    }

    public function criar()
    {
        if (isset($_POST['titulo']) && isset($_POST['descricao'])) {
            $titulo = trim($_POST['titulo']);
            $descricao = trim($_POST['descricao']);
            if (!empty($titulo) && !empty($descricao)) {
                $usuarioId = 1;
                $this->ideiaService->criarIdeia($titulo, $descricao, $usuarioId);
            }
        }
        header('Location: ' . BASE_URL);
        exit();
    }

    public function editar($id)
    {
        $ideia = null;
        $todas = $this->ideiaService->buscarTodas();
        foreach ($todas as $item) {
            if ($item->id == $id) {
                $ideia = $item;
                break;
            }
        }
        if ($ideia) {
            require __DIR__ . '/../views/ideia/editar.php';
        } else {
            echo '<h2>Ideia não encontrada!</h2>';
        }
    }

    public function atualizar($id)
    {
        if (isset($_POST['titulo']) && isset($_POST['descricao'])) {
            $titulo = trim($_POST['titulo']);
            $descricao = trim($_POST['descricao']);
            $todas = $this->ideiaService->buscarTodas();
            foreach ($todas as $item) {
                if ($item->id == $id) {
                    $usuarioId = $item->usuario_id;
                    $this->ideiaService->atualizarIdeia($id, $titulo, $descricao, $usuarioId);
                    break;
                }
            }
        }
        header('Location: ' . BASE_URL);
        exit();
    }

    // Método para excluir uma ideia
    public function excluir($id)
    {
        $usuarioLogadoId = $_SESSION['usuario_id'] ?? null;
        $isAdmin = $_SESSION['is_admin'] ?? 0;
        $todas = $this->ideiaService->buscarTodas();
        foreach ($todas as $item) {
            if ($item->id == $id) {
                if ($usuarioLogadoId == $item->usuario_id || $isAdmin) {
                    $this->ideiaService->excluirIdeia($id);
                }
                break;
            }
        }
        header('Location: ' . BASE_URL);
        exit();
    }
}

