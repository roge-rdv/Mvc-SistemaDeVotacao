<?php

class UsuarioService {
    private $usuarioDAO;
    
    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }
    
    public function cadastrar($nome, $email, $senha, $confirmarSenha) {
        // Validações
        $erros = [];
        
        if (empty($nome)) {
            $erros[] = "Nome é obrigatório";
        }
        
        if (empty($email)) {
            $erros[] = "Email é obrigatório";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Email inválido";
        } elseif ($this->usuarioDAO->buscarPorEmail($email)) {
            $erros[] = "Este email já está cadastrado";
        }
        
        if (empty($senha)) {
            $erros[] = "Senha é obrigatória";
        } elseif (strlen($senha) < 6) {
            $erros[] = "Senha deve ter pelo menos 6 caracteres";
        }
        
        if ($senha !== $confirmarSenha) {
            $erros[] = "Senhas não coincidem";
        }
        
        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros];
        }
        
        // Criar usuário
        $sucesso = $this->usuarioDAO->criar($nome, $email, $senha);
        
        if ($sucesso) {
            return ['sucesso' => true, 'mensagem' => 'Usuário cadastrado com sucesso'];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao cadastrar usuário']];
        }
    }
    
    public function login($email, $senha) {
        if (empty($email) || empty($senha)) {
            return ['sucesso' => false, 'erro' => 'Email e senha são obrigatórios'];
        }
        
        $usuario = $this->usuarioDAO->verificarSenha($email, $senha);
        
        if ($usuario) {
            // Inicia sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            return ['sucesso' => true, 'usuario' => $usuario];
        } else {
            return ['sucesso' => false, 'erro' => 'Email ou senha incorretos'];
        }
    }
    
    public function logout() {
        session_destroy();
        return ['sucesso' => true, 'mensagem' => 'Logout realizado com sucesso'];
    }
    
    public function obterUsuarioLogado() {
        if (isset($_SESSION['usuario_id'])) {
            return [
                'id' => $_SESSION['usuario_id'],
                'nome' => $_SESSION['usuario_nome'],
                'email' => $_SESSION['usuario_email']
            ];
        }
        return null;
    }
    
    public function verificarAutenticacao() {
        return isset($_SESSION['usuario_id']);
    }
    
    public function atualizar($id, $nome, $email) {
        $erros = [];
        
        if (empty($nome)) {
            $erros[] = "Nome é obrigatório";
        }
        
        if (empty($email)) {
            $erros[] = "Email é obrigatório";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Email inválido";
        }
        
        // Verifica se o email já existe para outro usuário
        $usuarioExistente = $this->usuarioDAO->buscarPorEmail($email);
        if ($usuarioExistente && $usuarioExistente['id'] != $id) {
            $erros[] = "Este email já está cadastrado";
        }
        
        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros];
        }
        
        $sucesso = $this->usuarioDAO->atualizar($id, $nome, $email);
        
        if ($sucesso) {
            // Atualiza dados da sessão
            if ($_SESSION['usuario_id'] == $id) {
                $_SESSION['usuario_nome'] = $nome;
                $_SESSION['usuario_email'] = $email;
            }
            return ['sucesso' => true, 'mensagem' => 'Usuário atualizado com sucesso'];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao atualizar usuário']];
        }
    }
    
    public function listarTodos() {
        return $this->usuarioDAO->listarTodos();
    }
    
    public function buscarPorId($id) {
        return $this->usuarioDAO->buscarPorId($id);
    }
}
?>