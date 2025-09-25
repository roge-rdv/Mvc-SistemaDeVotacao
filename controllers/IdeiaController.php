<?php

class IdeiaController {
    private $ideiaService;
    private $usuarioService;
    
    public function __construct() {
        $this->ideiaService = new IdeiaService();
        $this->usuarioService = new UsuarioService();
    }
    
    // Método home (alias para index)
    public function home() {
        $this->index();
    }
    
    // Página inicial - listar todas as ideias
    public function index() {
        $ideias = $this->ideiaService->listarTodas();
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        include '../views/ideias/index.php';
    }
    
    // Exibir formulário de criação de ideia
    public function criar() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $usuario_logado = $this->usuarioService->obterUsuarioLogado();
            
            $resultado = $this->ideiaService->criar($titulo, $descricao, $usuario_logado['id']);
            
            if ($resultado['sucesso']) {
                $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
                header('Location: index.php');
                exit;
            } else {
                $erros = $resultado['erros'];
            }
        }
        
        include '../views/ideias/criar.php';
    }
    
    // Visualizar detalhes de uma ideia
    public function visualizar() {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header('Location: index.php');
            exit;
        }
        
        $ideia = $this->ideiaService->buscarComDetalhes($id);
        
        if (!$ideia) {
            $_SESSION['mensagem_erro'] = 'Ideia não encontrada';
            header('Location: index.php');
            exit;
        }
        
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        include '../views/ideias/visualizar.php';
    }
    
    // Editar ideia
    public function editar() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $id = $_GET['id'] ?? null;
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        if (!$id) {
            header('Location: index.php');
            exit;
        }
        
        $ideia = $this->ideiaService->buscarPorId($id);
        
        if (!$ideia || $ideia['usuario_id'] != $usuario_logado['id']) {
            $_SESSION['mensagem_erro'] = 'Você não tem permissão para editar esta ideia';
            header('Location: index.php');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            
            $resultado = $this->ideiaService->atualizar($id, $titulo, $descricao, $usuario_logado['id']);
            
            if ($resultado['sucesso']) {
                $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
                header('Location: index.php?controller=ideia&action=visualizar&id=' . $id);
                exit;
            } else {
                $erros = $resultado['erros'];
            }
        }
        
        include '../views/ideias/editar.php';
    }
    
    // Excluir ideia
    public function excluir() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $id = $_GET['id'] ?? null;
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        if (!$id) {
            header('Location: index.php');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->ideiaService->excluir($id, $usuario_logado['id']);
            
            if ($resultado['sucesso']) {
                $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
            } else {
                $_SESSION['mensagem_erro'] = implode(', ', $resultado['erros']);
            }
            
            header('Location: index.php');
            exit;
        }
        
        $ideia = $this->ideiaService->buscarPorId($id);
        
        if (!$ideia || $ideia['usuario_id'] != $usuario_logado['id']) {
            $_SESSION['mensagem_erro'] = 'Você não tem permissão para excluir esta ideia';
            header('Location: index.php');
            exit;
        }
        
        include '../views/ideias/excluir.php';
    }
    
    // Buscar ideias
    public function buscar() {
        $termo = $_GET['q'] ?? '';
        
        if (empty($termo)) {
            header('Location: index.php');
            exit;
        }
        
        // Aqui poderia implementar uma busca mais sofisticada
        // Por enquanto, listaremos todas e deixaremos o JS filtrar
        $ideias = $this->ideiaService->listarTodas();
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        include '../views/ideias/buscar.php';
    }
}
?>