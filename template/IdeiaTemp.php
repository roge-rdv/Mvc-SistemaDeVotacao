<?php
namespace template;

/**
 * Classe IdeiaTemp - Implementa templates para ideias
 * Segue o padrão básico do material da aula
 */
class IdeiaTemp implements ITemplate {
    
    public function cabecalho() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Sistema de Votação de Ideias</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f8f9fa; }
                .header { background: #007bff; color: white; padding: 15px; text-align: center; margin: -20px -20px 20px -20px; }
                .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                .btn { display: inline-block; padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin: 5px; }
                .btn:hover { background: #0056b3; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background: #f8f9fa; font-weight: bold; }
                tr:hover { background: #f5f5f5; }
                .form-group { margin: 15px 0; }
                label { display: block; margin-bottom: 5px; font-weight: bold; }
                input, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
                textarea { height: 100px; resize: vertical; }
                .submit-btn { background: #28a745; padding: 10px 20px; border: none; border-radius: 4px; color: white; cursor: pointer; }
                .submit-btn:hover { background: #218838; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>💡 Sistema de Votação de Ideias</h1>
            </div>
            <div class="container">
        <?php
    }
    
    public function rodape() {
        ?>
            </div>
            <div style="text-align: center; margin-top: 20px; color: #666;">
                <small>© <?= date('Y') ?> - Sistema de Votação de Ideias</small>
            </div>
        </body>
        </html>
        <?php
    }
    
    public function layout($caminho, $parametro = null) {
        $this->cabecalho();
        include $_SERVER["DOCUMENT_ROOT"] . "/votacao-mvc/" . $caminho;
        $this->rodape();
    }
}
?>