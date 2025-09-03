-- Active: 1756910509908@@localhost@3306
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
