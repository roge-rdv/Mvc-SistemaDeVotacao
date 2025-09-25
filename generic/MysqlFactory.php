<?php
namespace generic;

/**
 * Classe MysqlFactory - Factory para conexão MySQL
 * Baseado no material da aula do professor
 */
class MysqlFactory {
    public $banco;
    
    public function __construct() {
        $this->banco = MysqlSingleton::getInstance();
    }
}
?>