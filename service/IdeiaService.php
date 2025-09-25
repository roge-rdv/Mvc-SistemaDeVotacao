<?php
namespace service;

use dao\mysql\IdeiaDAO;

/**
 * Classe IdeiaService - Service básico
 * Baseado no material da aula do professor
 */
class IdeiaService extends IdeiaDAO {
    
    public function listarIdeia() {
        return parent::listar();
    }
    
    public function inserir($titulo, $descricao) {
        return parent::inserir($titulo, $descricao);
    }
    
    public function listarId($id) {
        return parent::listarId($id);
    }
}
?>