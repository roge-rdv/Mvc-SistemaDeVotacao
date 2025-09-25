<?php

class UsuarioController {
    private $usuarioService;
    
    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }
    
    // Página inicial de usuários
    public function index() {
        $usuarios = $this->usuarioService->listarTodos();
        include '../views/usuarios/index.php';
    }
    
    // Exibir formulário de cadastro
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $confirmarSenha = $_POST['confirmar_senha'] ?? '';
            
            $resultado = $this->usuarioService->cadastrar($nome, $email, $senha, $confirmarSenha);
            
            if ($resultado['sucesso']) {
                $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
                header('Location: index.php?controller=usuario&action=login');
                exit;
            } else {
                $erros = $resultado['erros'];
            }
        }
        
        include '../views/usuarios/cadastrar.php';
    }
    
    // Exibir formulário de login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            
            $resultado = $this->usuarioService->login($email, $senha);
            
            if ($resultado['sucesso']) {
                header('Location: index.php');
                exit;
            } else {
                $erro = $resultado['erro'];
            }
        }
        
        include '../views/usuarios/login.php';
    }
    
    // Logout
    public function logout() {
        $this->usuarioService->logout();
        header('Location: index.php');
        exit;
    }
    
    // Exibir perfil do usuário
    public function perfil() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        $usuario = $this->usuarioService->buscarPorId($usuario_logado['id']);
        
        include '../views/usuarios/perfil.php';
    }
    
    // Editar usuário
    public function editar() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        $id = $_GET['id'] ?? $usuario_logado['id'];
        
        // Usuário só pode editar seu próprio perfil
        if ($id != $usuario_logado['id']) {
            header('Location: index.php?controller=usuario&action=perfil');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            
            $resultado = $this->usuarioService->atualizar($id, $nome, $email);
            
            if ($resultado['sucesso']) {
                $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
                header('Location: index.php?controller=usuario&action=perfil');
                exit;
            } else {
                $erros = $resultado['erros'];
            }
        }
        
        $usuario = $this->usuarioService->buscarPorId($id);
        include '../views/usuarios/editar.php';
    }
    
    // Listar ideias do usuário
    public function minhasIdeias() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        $ideiaService = new IdeiaService();
        $ideias = $ideiaService->listarPorUsuario($usuario_logado['id']);
        
        include '../views/usuarios/minhas-ideias.php';
    }
    
    // Listar votos do usuário
    public function meusVotos() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        $votoService = new VotoService();
        $votos = $votoService->listarVotosDoUsuario($usuario_logado['id']);
        
        include '../views/usuarios/meus-votos.php';
    }
}
?>