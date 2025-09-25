<?php

class IdeiaService {
    private $ideiaDAO;
    private $votoDAO;
    
    public function __construct() {
        $this->ideiaDAO = new IdeiaDAO();
        $this->votoDAO = new VotoDAO();
    }
    
    public function criar($titulo, $descricao, $usuario_id) {
        // Validações
        $erros = [];
        
        if (empty($titulo)) {
            $erros[] = "Título é obrigatório";
        } elseif (strlen($titulo) > 150) {
            $erros[] = "Título deve ter no máximo 150 caracteres";
        }
        
        if (empty($descricao)) {
            $erros[] = "Descrição é obrigatória";
        } elseif (strlen($descricao) < 10) {
            $erros[] = "Descrição deve ter pelo menos 10 caracteres";
        }
        
        if (empty($usuario_id)) {
            $erros[] = "Usuário não identificado";
        }
        
        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros];
        }
        
        // Criar ideia
        $sucesso = $this->ideiaDAO->criar($titulo, $descricao, $usuario_id);
        
        if ($sucesso) {
            return ['sucesso' => true, 'mensagem' => 'Ideia criada com sucesso'];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao criar ideia']];
        }
    }
    
    public function listarTodas() {
        $ideias = $this->ideiaDAO->listarTodas();
        
        // Para cada ideia, verifica se o usuário logado já votou
        if (isset($_SESSION['usuario_id'])) {
            foreach ($ideias as &$ideia) {
                $ideia['usuario_ja_votou'] = $this->votoDAO->verificarVoto($_SESSION['usuario_id'], $ideia['id']);
            }
        }
        
        return $ideias;
    }
    
    public function buscarPorId($id) {
        $ideia = $this->ideiaDAO->buscarPorId($id);
        
        if ($ideia && isset($_SESSION['usuario_id'])) {
            $ideia['usuario_ja_votou'] = $this->votoDAO->verificarVoto($_SESSION['usuario_id'], $id);
        }
        
        return $ideia;
    }
    
    public function listarPorUsuario($usuario_id) {
        return $this->ideiaDAO->listarPorUsuario($usuario_id);
    }
    
    public function atualizar($id, $titulo, $descricao, $usuario_id) {
        // Validações
        $erros = [];
        
        if (empty($titulo)) {
            $erros[] = "Título é obrigatório";
        } elseif (strlen($titulo) > 150) {
            $erros[] = "Título deve ter no máximo 150 caracteres";
        }
        
        if (empty($descricao)) {
            $erros[] = "Descrição é obrigatória";
        } elseif (strlen($descricao) < 10) {
            $erros[] = "Descrição deve ter pelo menos 10 caracteres";
        }
        
        // Verifica se o usuário é o proprietário da ideia
        if (!$this->ideiaDAO->verificarProprietario($id, $usuario_id)) {
            $erros[] = "Você não tem permissão para editar esta ideia";
        }
        
        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros];
        }
        
        // Atualizar ideia
        $sucesso = $this->ideiaDAO->atualizar($id, $titulo, $descricao);
        
        if ($sucesso) {
            return ['sucesso' => true, 'mensagem' => 'Ideia atualizada com sucesso'];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao atualizar ideia']];
        }
    }
    
    public function excluir($id, $usuario_id) {
        // Verifica se o usuário é o proprietário da ideia
        if (!$this->ideiaDAO->verificarProprietario($id, $usuario_id)) {
            return ['sucesso' => false, 'erros' => ['Você não tem permissão para excluir esta ideia']];
        }
        
        $sucesso = $this->ideiaDAO->excluir($id);
        
        if ($sucesso) {
            return ['sucesso' => true, 'mensagem' => 'Ideia excluída com sucesso'];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao excluir ideia']];
        }
    }
    
    public function buscarComDetalhes($id) {
        $ideia = $this->buscarPorId($id);
        
        if ($ideia) {
            // Busca os votantes desta ideia
            $ideia['votantes'] = $this->votoDAO->listarVotantesDeIdeia($id);
        }
        
        return $ideia;
    }
}
?>