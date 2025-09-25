<?php
require_once __DIR__ . '/../services/VotoService.php';
require_once __DIR__ . '/../config.php';

class VotoController {
    private $votoService;

    public function __construct($pdo) {
        $this->votoService = new VotoService($pdo);
    }

    // Votar em uma ideia
    public function votar($usuarioId, $ideiaId) {
        return $this->votoService->votar($usuarioId, $ideiaId);
    }

    // Desvotar uma ideia
    public function desvotar($usuarioId, $ideiaId) {
        return $this->votoService->desvotar($usuarioId, $ideiaId);
    }

    // Verificar se usuário já votou
    public function jaVotou($usuarioId, $ideiaId) {
        return $this->votoService->jaVotou($usuarioId, $ideiaId);
    }

    // Contar votos de uma ideia
    public function contarVotos($ideiaId) {
        return $this->votoService->contarVotos($ideiaId);
    }
}
