<?php
namespace generic;

/**
 * Classe Acao - Sistema genérico de ações
 * Baseado no material da aula do professor
 */
class Acao {
    private $classe;
    private $metodo;
    
    public function __construct($classe, $metodo) {
        $this->classe = "controller\\" . $classe;
        $this->metodo = $metodo;
    }
    
    public function executar() {
        $obj = new $this->classe();
        $obj->{$this->metodo}();
    }
}
?>