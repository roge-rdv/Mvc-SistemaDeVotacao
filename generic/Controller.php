<?php
namespace generic;

/**
 * Classe Controller - Sistema genérico de controle
 * Baseado no material da aula do professor
 */
class Controller {
    private $arrChamadas = [];
    
    public function __construct() {
        $this->arrChamadas = [
            "ideia/lista" => new Acao("Ideia", "listar"),
            "ideia/formulario" => new Acao("Ideia", "formulario"),
            "ideia/inserir" => new Acao("Ideia", "inserir"),
            "usuario/lista" => new Acao("Usuario", "listar"),
            "usuario/formulario" => new Acao("Usuario", "formulario"),
            "usuario/inserir" => new Acao("Usuario", "inserir")
        ];
    }
    
    public function verificarChamadas($rota) {
        if (isset($this->arrChamadas[$rota])) {
            // acao da rota
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
        }
        
        echo "Rota não existe!";
    }
}
?>