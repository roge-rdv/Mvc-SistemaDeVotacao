<?php
namespace dao;

/**
 * Interface IIdeiaDAO - DAO básico para ideias
 * Baseado no material da aula do professor
 */
interface IIdeiaDAO {
    public function listar();
    public function inserir($titulo, $descricao);
    public function listarId($id);
}
?>