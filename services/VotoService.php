<?php
require_once __DIR__ . '/../daos/VotoDAO.php';

class VotoService {
    private $votoDAO;

    public function __construct($pdo) {
        $this->votoDAO = new VotoDAO($pdo);
    }

    public function votar($usuarioId, $ideiaId) {
        if (!$this->votoDAO->jaVotou($usuarioId, $ideiaId)) {
            return $this->votoDAO->votar($usuarioId, $ideiaId);
        }
        return false;
    }

    public function desvotar($usuarioId, $ideiaId) {
        if ($this->votoDAO->jaVotou($usuarioId, $ideiaId)) {
            return $this->votoDAO->desvotar($usuarioId, $ideiaId);
        }
        return false;
    }

    public function jaVotou($usuarioId, $ideiaId) {
        return $this->votoDAO->jaVotou($usuarioId, $ideiaId);
    }

    public function contarVotos($ideiaId) {
        return $this->votoDAO->contarVotos($ideiaId);
    }
}
