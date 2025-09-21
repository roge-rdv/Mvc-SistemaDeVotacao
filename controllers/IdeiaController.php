
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
        // Passa as ideias para a view
        require __DIR__ . '/../views/ideia/listar.php';
    }

    // Novo método para criar uma ideia
    public function criar()
    {
        // Verifica se os dados do formulário foram enviados
        if (isset($_POST['titulo']) && isset($_POST['descricao'])) {
            $titulo = trim($_POST['titulo']);
            $descricao = trim($_POST['descricao']);

            // Validação simples
            if (!empty($titulo) && !empty($descricao)) {
                // Chama o serviço para salvar a ideia
                // (Assumindo que o usuário com ID 1 está logado, para fins de exemplo)
                $usuarioId = 1; 
                $this->ideiaService->criarIdeia($titulo, $descricao, $usuarioId);
            }
        }

        // Redireciona de volta para a página inicial após a submissão
        header('Location: ' . BASE_URL);
        exit();
    }

    // Método para exibir o formulário de edição de uma ideia
    public function editar($id)
    {
        $ideia = null;
        // Buscar a ideia pelo id
        $todas = $this->ideiaService->buscarTodas();
        foreach ($todas as $item) {
            if ($item->id == $id) {
                $ideia = $item;
                break;
            }
        }
        if ($ideia) {
            // Passa a ideia para a view de edição
            require __DIR__ . '/../views/ideia/editar.php';
        } else {
            echo '<h2>Ideia não encontrada!</h2>';
        }
    }

    // Método para atualizar uma ideia existente
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
}

