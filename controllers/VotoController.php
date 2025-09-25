<?php

class VotoController {
    private $votoService;
    private $usuarioService;
    private $ideiaService;
    
    public function __construct() {
        $this->votoService = new VotoService();
        $this->usuarioService = new UsuarioService();
        $this->ideiaService = new IdeiaService();
    }
    
    // Alternar voto (votar ou remover voto)
    public function alternar() {
        // Verificar autenticação
        if (!$this->usuarioService->verificarAutenticacao()) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode(['sucesso' => false, 'erro' => 'Você precisa fazer login para votar']);
                exit;
            } else {
                header('Location: index.php?controller=usuario&action=login');
                exit;
            }
        }
        
        $ideia_id = $_POST['ideia_id'] ?? null;
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        if (!$ideia_id) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode(['sucesso' => false, 'erro' => 'Ideia não identificada']);
                exit;
            } else {
                header('Location: index.php');
                exit;
            }
        }
        
        $resultado = $this->votoService->alternarVoto($usuario_logado['id'], $ideia_id);
        
        // Se for uma requisição AJAX, retorna JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            if ($resultado['sucesso']) {
                echo json_encode([
                    'sucesso' => true,
                    'mensagem' => $resultado['mensagem'],
                    'total_votos' => $resultado['total_votos'],
                    'usuario_ja_votou' => $this->votoService->verificarSeJaVotou($usuario_logado['id'], $ideia_id)
                ]);
            } else {
                echo json_encode([
                    'sucesso' => false,
                    'erro' => implode(', ', $resultado['erros'])
                ]);
            }
            exit;
        }
        
        // Se não for AJAX, redireciona com mensagem
        if ($resultado['sucesso']) {
            $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
        } else {
            $_SESSION['mensagem_erro'] = implode(', ', $resultado['erros']);
        }
        
        // Redireciona de volta para a página anterior ou para home
        $redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header('Location: ' . $redirect);
        exit;
    }
    
    // Votar em uma ideia
    public function votar() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $ideia_id = $_POST['ideia_id'] ?? null;
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        if (!$ideia_id) {
            header('Location: index.php');
            exit;
        }
        
        $resultado = $this->votoService->votar($usuario_logado['id'], $ideia_id);
        
        if ($resultado['sucesso']) {
            $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
        } else {
            $_SESSION['mensagem_erro'] = implode(', ', $resultado['erros']);
        }
        
        header('Location: index.php?controller=ideia&action=visualizar&id=' . $ideia_id);
        exit;
    }
    
    // Remover voto de uma ideia
    public function removerVoto() {
        if (!$this->usuarioService->verificarAutenticacao()) {
            header('Location: index.php?controller=usuario&action=login');
            exit;
        }
        
        $ideia_id = $_POST['ideia_id'] ?? null;
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        if (!$ideia_id) {
            header('Location: index.php');
            exit;
        }
        
        $resultado = $this->votoService->removerVoto($usuario_logado['id'], $ideia_id);
        
        if ($resultado['sucesso']) {
            $_SESSION['mensagem_sucesso'] = $resultado['mensagem'];
        } else {
            $_SESSION['mensagem_erro'] = implode(', ', $resultado['erros']);
        }
        
        header('Location: index.php?controller=ideia&action=visualizar&id=' . $ideia_id);
        exit;
    }
    
    // Listar todos os votos (para admin)
    public function index() {
        // Esta função pode ser usada para relatórios administrativos
        // Por enquanto, redireciona para home
        header('Location: index.php');
        exit;
    }
    
    // Listar votantes de uma ideia específica
    public function votantes() {
        $ideia_id = $_GET['ideia_id'] ?? null;
        
        if (!$ideia_id) {
            header('Location: index.php');
            exit;
        }
        
        $ideia = $this->ideiaService->buscarPorId($ideia_id);
        
        if (!$ideia) {
            $_SESSION['mensagem_erro'] = 'Ideia não encontrada';
            header('Location: index.php');
            exit;
        }
        
        $votantes = $this->votoService->listarVotantesDeIdeia($ideia_id);
        $usuario_logado = $this->usuarioService->obterUsuarioLogado();
        
        include '../views/votos/votantes.php';
    }
    
    // Obter estatísticas de votos via AJAX
    public function estatisticas() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $ideia_id = $_GET['ideia_id'] ?? null;
            
            if ($ideia_id) {
                $total_votos = $this->votoService->contarVotosPorIdeia($ideia_id);
                $usuario_logado = $this->usuarioService->obterUsuarioLogado();
                $usuario_ja_votou = false;
                
                if ($usuario_logado) {
                    $usuario_ja_votou = $this->votoService->verificarSeJaVotou($usuario_logado['id'], $ideia_id);
                }
                
                echo json_encode([
                    'sucesso' => true,
                    'total_votos' => $total_votos,
                    'usuario_ja_votou' => $usuario_ja_votou
                ]);
                exit;
            }
        }
        
        header('Location: index.php');
        exit;
    }
}
?>