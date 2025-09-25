<?php
namespace template;

/**
 * Interface ITemplate - Sistema de Templates Básico
 * Baseado no material da aula do professor
 */
interface ITemplate {
    public function cabecalho();
    public function rodape();
    public function layout($caminho, $parametro = null);
}
?>