<?php
require_once __DIR__ . '/../config.php';

class RegisterController {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    }

    public function register($nome, $email, $senha, $is_admin = 0) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, is_admin) VALUES (:nome, :email, :senha, :is_admin)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $hash, PDO::PARAM_STR);
        $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
