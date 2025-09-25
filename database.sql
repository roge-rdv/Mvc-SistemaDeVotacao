-- Script SQL para criação do banco de dados do Sistema de Votação de Ideias

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sistema_votacao CHARACTER SET utf8 COLLATE utf8_general_ci;

USE sistema_votacao;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de ideias
CREATE TABLE ideias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    usuario_id INT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de votos
CREATE TABLE votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    ideia_id INT NOT NULL,
    data_voto TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (ideia_id) REFERENCES ideias(id) ON DELETE CASCADE,
    UNIQUE KEY unique_voto (usuario_id, ideia_id)
);

-- Inserção de dados de exemplo para testes
INSERT INTO usuarios (nome, email, senha) VALUES 
('João Silva', 'joao@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- senha: password
('Maria Santos', 'maria@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- senha: password
('Pedro Lima', 'pedro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- senha: password

INSERT INTO ideias (titulo, descricao, usuario_id) VALUES 
('Sistema de Feedback Online', 'Implementar um sistema para coletar feedback dos usuários sobre produtos e serviços', 1),
('App de Carona Solidária', 'Criar um aplicativo para conectar pessoas que oferecem e procuram caronas', 2),
('Plataforma de Ensino Gratuito', 'Desenvolver uma plataforma online para disponibilizar cursos gratuitos', 1);

INSERT INTO votos (usuario_id, ideia_id) VALUES 
(2, 1),
(3, 1),
(1, 2),
(3, 2),
(2, 3);