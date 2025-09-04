-- Active: 1743912631785@@localhost@3306@mostra2025
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--criando a database
CREATE DATABASE IF NOT EXISTS `mostra2025`;
USE mostra2025;

--criando as tabelas
--tabela para identificar os usuarios da página
CREATE TABLE IF NOT EXISTS `usuarios` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

--tabela para as perguntas que serão feitas
CREATE TABLE IF NOT EXISTS `perguntas`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    texto_pergunta VARCHAR(150) NOT NULL,
    filme_associado VARCHAR(100) NOT NULL,
    nivel_dificuldade INT NOT NULL,
    autor_pergunta VARCHAR(15) NOT NULL
);

-- Tabela para as respostas das perguntas
CREATE TABLE IF NOT EXISTS `respostas`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pergunta INT NOT NULL,
    texto_resposta VARCHAR(50) NOT NULL, 
    correta BOOLEAN NOT NULL,
    FOREIGN KEY (id_pergunta) REFERENCES perguntas(id) ON DELETE CASCADE
);

--tabela para a tabela que o usuario ver os resultados
CREATE TABLE IF NOT EXISTS `tabela`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    pontuacao INT NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tempo_gasto_segundos INT NOT NULL,
    Foreign Key (id_usuario) REFERENCES usuarios(id)
);

--tabela para a pagina makeoff
CREATE TABLE IF NOT EXISTS `makeoff`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_arquivo VARCHAR(100) NOT NULL,
    caminho_arquivo VARCHAR(255) NOT NULL,
    legenda VARCHAR(255) NOT NULL,
    autor varchar(100) NOT NULL,
    data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
--Tabela para registrar acessos
CREATE TABLE IF NOT EXISTS `acessos`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    navegador VARCHAR(255) NOT NULL,
    ip VARCHAR(255) NOT NULL
);
select * from perguntas;
select * from respostas;
drop table acessos;

drop table perguntas;
drop table respostas;

-- Inserts na tabela perguntas
INSERT INTO perguntas (texto_pergunta, filme_associado, nivel_dificuldade, autor_pergunta) VALUES
('Qual é o nome do hobbit principal em O Senhor dos Anéis?', 'O Senhor dos Anéis', 1, 'Gabriel'),
('Quem é o vilão principal em Star Wars: Episódio V?', 'Star Wars', 2, 'Gabriel'),
('Qual o nome do brinquedo cowboy em Toy Story?', 'Toy Story', 1, 'Gabriel'),
('Em Matrix, qual é o nome verdadeiro de Neo?', 'Matrix', 3, 'Gabriel'),
('Quem dirigiu o filme A Origem (Inception)?', 'A Origem', 3, 'Gabriel'),
('Qual é a cor da pílula escolhida por Neo em Matrix?', 'Matrix', 2, 'Gabriel'),
('Quem é o pai de Simba em O Rei Leão?', 'O Rei Leão', 1, 'Gabriel'),
('Qual atriz interpreta Katniss Everdeen em Jogos Vorazes?', 'Jogos Vorazes', 2, 'Gabriel'),
('Em Titanic, qual é o nome do personagem de Leonardo DiCaprio?', 'Titanic', 2, 'Gabriel'),
('Qual é o planeta natal do Superman?', 'Superman', 1, 'Gabriel');

-- Respostas da pergunta 1
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(1, 'Frodo', TRUE),
(1, 'Sam', FALSE),
(1, 'Bilbo', FALSE),
(1, 'Merry', FALSE);

-- Pergunta 2
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(2, 'Darth Vader', TRUE),
(2, 'Darth Sidious', FALSE),
(2, 'Kylo Ren', FALSE),
(2, 'Conde Dookan', FALSE);

-- Pergunta 3
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(3, 'Woody', TRUE),
(3, 'Buzz', FALSE),
(3, 'Jessie', FALSE),
(3, 'Rex', FALSE);

-- Pergunta 4
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(4, 'Thomas Anderson', TRUE),
(4, 'John Smith', FALSE),
(4, 'Morpheus', FALSE),
(4, 'Trinity', FALSE);

-- Pergunta 5
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(5, 'Christopher Nolan', TRUE),
(5, 'Steven Spielberg', FALSE),
(5, 'James Cameron', FALSE),
(5, 'Ridley Scott', FALSE);

-- Pergunta 6
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(6, 'Azul', TRUE),
(6, 'Vermelha', FALSE),
(6, 'Verde', FALSE),
(6, 'Amarela', FALSE);

-- Pergunta 7
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(7, 'Mufasa', TRUE),
(7, 'Scar', FALSE),
(7, 'Rafiki', FALSE),
(7, 'Zazu', FALSE);

-- Pergunta 8
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(8, 'Jennifer Lawrence', TRUE),
(8, 'Emma Watson', FALSE),
(8, 'Kristen Stewart', FALSE),
(8, 'Natalie Portman', FALSE);

-- Pergunta 9
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(9, 'Jack Dawson', TRUE),
(9, 'Mark Johnson', FALSE),
(9, 'James Rose', FALSE),
(9, 'William Turner', FALSE);

-- Pergunta 10
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
(10, 'Krypton', TRUE),
(10, 'Vulcano', FALSE),
(10, 'Asgard', FALSE),
(10, 'Terra-X', FALSE);
