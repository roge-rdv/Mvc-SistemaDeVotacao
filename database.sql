-- Primeiro, crie o banco de dados se ele não existir
CREATE DATABASE IF NOT EXISTS votacao_ideias_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use o banco de dados recém-criado
USE votacao_ideias_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Tabela de ideias
CREATE TABLE ideias (
    id INT AUTO_INCREMENT PRIMARY KEY,
-- Tabela de comentários
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ideia_id INT NOT NULL,
    usuario_id INT NOT NULL,
    texto TEXT NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ideia_id) REFERENCES ideias(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;
    descricao TEXT NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL -- Se o usuário for deletado, a ideia permanece
) ENGINE=InnoDB;

-- Tabela de votos
CREATE TABLE votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    ideia_id INT,
    -- Chave única para garantir que um usuário só pode votar uma vez em cada ideia
    UNIQUE KEY unique_voto (usuario_id, ideia_id), 
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE, -- Se o usuário for deletado, seus votos também são
    FOREIGN KEY (ideia_id) REFERENCES ideias(id) ON DELETE CASCADE -- Se a ideia for deletada, seus votos também são
) ENGINE=InnoDB;

-- Inserindo alguns dados de exemplo para teste
INSERT INTO `usuarios` (`nome`, `email`, `senha`) VALUES
('Ana Silva', 'ana.silva@email.com', 'senha123'),
('Bruno Costa', 'bruno.costa@email.com', 'senha456'),
('Carla Dias', 'carla.dias@email.com', 'senha789');

INSERT INTO `ideias` (`titulo`, `descricao`, `usuario_id`) VALUES
('Plataforma de Estudo em Grupo Online', 'Uma plataforma interativa onde estudantes podem formar grupos de estudo, compartilhar materiais e agendar sessões de vídeo.', 1),
('Aplicativo para Adoção de Animais de Rua', 'Um app que conecta ONGs e protetores independentes com pessoas interessadas em adotar um pet, com fotos, histórico e processo de adoção facilitado.', 2),
('Sistema de Recompensa por Reciclagem', 'Um sistema onde os cidadãos podem levar lixo reciclável a pontos de coleta e acumular pontos para trocar por descontos em comércios locais.', 1);
