<?php
namespace controller;

use service\IdeiaService;
use template\IdeiaTemp;
use template\ITemplate;

/**
 * Classe Ideia - Controller básico
 * Baseado no material da aula do professor
 */
class Ideia {
    
    private ITemplate $template;
    
    public function __construct() {
        $this->template = new IdeiaTemp();
    }
    
    public function listar() {
        $service = new IdeiaService();
        $resultado = $service->listarIdeia();
        $this->template->layout("public/ideia/listar.php", $resultado);
    }
    
    public function inserir() {
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $service = new IdeiaService();
        $resultado = $service->inserir($titulo, $descricao);
        header("location: /votacao-mvc/public/?param=ideia/lista");
    }
    
    public function formulario() {
        $this->template->layout("public/ideia/form.php");
    }
}
?>