<?php
/**
 * Ponto de entrada principal do Sistema de Votação de Ideias
 * 
 * Este arquivo redireciona automaticamente para a pasta public
 * onde está o verdadeiro index.php da aplicação.
 * 
 * Estrutura do projeto:
 * - /index.php (este arquivo) - Ponto de entrada
 * - /public/index.php - Aplicação principal
 * - /config/ - Configurações
 * - /models/ - Modelos de dados
 * - /controllers/ - Controladores
 * - /services/ - Serviços de negócio
 * - /views/ - Templates
 */

// Redirecionar para a pasta public
header('Location: public/');
exit;
?>