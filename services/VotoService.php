<?php

class VotoService {
    private $votoDAO;
    private $ideiaDAO;
    
    public function __construct() {
        $this->votoDAO = new VotoDAO();
        $this->ideiaDAO = new IdeiaDAO();
    }
    
    public function votar($usuario_id, $ideia_id) {
        // Validações
        $erros = [];
        
        if (empty($usuario_id)) {
            $erros[] = "Usuário não identificado";
        }
        
        if (empty($ideia_id)) {
            $erros[] = "Ideia não identificada";
        }
        
        // Verifica se a ideia existe
        $ideia = $this->ideiaDAO->buscarPorId($ideia_id);
        if (!$ideia) {
            $erros[] = "Ideia não encontrada";
        }
        
        // Verifica se o usuário não está votando na própria ideia
        if ($ideia && $ideia['usuario_id'] == $usuario_id) {
            $erros[] = "Você não pode votar na sua própria ideia";
        }
        
        // Verifica se o usuário já votou nesta ideia
        if ($this->votoDAO->verificarVoto($usuario_id, $ideia_id)) {
            $erros[] = "Você já votou nesta ideia";
        }
        
        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros];
        }
        
        // Realizar voto
        $sucesso = $this->votoDAO->votar($usuario_id, $ideia_id);
        
        if ($sucesso) {
            $total_votos = $this->votoDAO->contarVotosPorIdeia($ideia_id);
            return [
                'sucesso' => true, 
                'mensagem' => 'Voto registrado com sucesso',
                'total_votos' => $total_votos
            ];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao registrar voto']];
        }
    }
    
    public function removerVoto($usuario_id, $ideia_id) {
        // Validações
        $erros = [];
        
        if (empty($usuario_id)) {
            $erros[] = "Usuário não identificado";
        }
        
        if (empty($ideia_id)) {
            $erros[] = "Ideia não identificada";
        }
        
        // Verifica se o usuário votou nesta ideia
        if (!$this->votoDAO->verificarVoto($usuario_id, $ideia_id)) {
            $erros[] = "Você não votou nesta ideia";
        }
        
        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros];
        }
        
        // Remover voto
        $sucesso = $this->votoDAO->removerVoto($usuario_id, $ideia_id);
        
        if ($sucesso) {
            $total_votos = $this->votoDAO->contarVotosPorIdeia($ideia_id);
            return [
                'sucesso' => true, 
                'mensagem' => 'Voto removido com sucesso',
                'total_votos' => $total_votos
            ];
        } else {
            return ['sucesso' => false, 'erros' => ['Erro ao remover voto']];
        }
    }
    
    public function alternarVoto($usuario_id, $ideia_id) {
        // Verifica se o usuário já votou
        if ($this->votoDAO->verificarVoto($usuario_id, $ideia_id)) {
            // Se já votou, remove o voto
            return $this->removerVoto($usuario_id, $ideia_id);
        } else {
            // Se não votou, adiciona o voto
            return $this->votar($usuario_id, $ideia_id);
        }
    }
    
    public function listarVotosDoUsuario($usuario_id) {
        return $this->votoDAO->listarVotosDoUsuario($usuario_id);
    }
    
    public function listarVotantesDeIdeia($ideia_id) {
        return $this->votoDAO->listarVotantesDeIdeia($ideia_id);
    }
    
    public function contarVotosPorIdeia($ideia_id) {
        return $this->votoDAO->contarVotosPorIdeia($ideia_id);
    }
    
    public function verificarSeJaVotou($usuario_id, $ideia_id) {
        return $this->votoDAO->verificarVoto($usuario_id, $ideia_id);
    }
    
    public function obterEstatisticas() {
        // Aqui poderia implementar estatísticas gerais do sistema
        // Por exemplo: total de votos, ideia mais votada, etc.
        return [
            'funcionalidade' => 'Estatísticas podem ser implementadas aqui'
        ];
    }
}
?>