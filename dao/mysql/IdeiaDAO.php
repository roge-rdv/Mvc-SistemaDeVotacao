<?php
namespace dao\mysql;

use dao\IIdeiaDAO;
use generic\MysqlFactory;

/**
 * Classe IdeiaDAO - DAO básico para MySQL
 * Baseado no material da aula do professor
 */
class IdeiaDAO extends MysqlFactory implements IIdeiaDAO {
    
    public function listar() {
        $sql = "select id,titulo,descricao,usuario_id from ideias";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }
    
    public function listarId($id) {
        $sql = "select id,titulo,descricao,usuario_id from ideias where id=:id";
        $param = [
            ":id" => $id
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
    
    public function inserir($titulo, $descricao) {
        $sql = "insert into ideias (titulo,descricao,usuario_id) values (:titulo,:descricao,1)";
        $param = [
            ":titulo" => $titulo,
            ":descricao" => $descricao
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
}
?>