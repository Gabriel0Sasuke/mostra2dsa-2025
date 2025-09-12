-- Active: 1743912631785@@localhost@3306@mostra2025
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--criando a database
CREATE DATABASE IF NOT EXISTS `mostra2025`;
USE mostra2025;

--criando as tabelas

--tabela para as perguntas que serão feitas
CREATE TABLE IF NOT EXISTS `perguntas`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    texto_pergunta VARCHAR(150) NOT NULL,
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
    id INT AUTO_INCREMENT PRIMARY KEY
    nome VARCHAR(100) NOT NULL,
    pontuacao INT NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Sala VARCHAR (10) NOT NULL,
    RM INT NOT NULL,    
    tempo_gasto_segundos INT NOT NULL
);

--tabela para a pagina makeoff
CREATE TABLE IF NOT EXISTS `makeoff`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_arquivo VARCHAR(100) NOT NULL,
    caminho_arquivo VARCHAR(255) NOT NULL,
    grupo VARCHAR(100) NOT NULL,
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
-- (Opcional) consultas rápidas
-- select * from perguntas;
-- select * from respostas;
 select * from tabela
-- CUIDADO: comentar para não apagar ao executar o script inteiro
-- drop table acessos;
-- drop table makeoff;
-- drop table perguntas;
-- drop table respostas;
-- drop table tabela

-- Inserts na tabela perguntas
INSERT INTO perguntas (id, texto_pergunta, autor_pergunta) VALUES
(1, 'Qual o nome do filme de Hitchcock famoso pela cena do chuveiro?', 'Auto'),
(2, 'Em Psicose, qual é o nome do motel?', 'Auto'),
(3, 'Qual atriz protagoniza a cena do chuveiro em Psicose?', 'Auto'),
(4, 'Em Os Pássaros, o que ameaça a cidade?', 'Auto'),
(5, 'Qual filme mostra um fotógrafo engessado investigando vizinhos?', 'Auto'),
(6, 'Qual filme tem avião pulverizador perseguindo o herói?', 'Auto'),
(7, 'Em Janela Indiscreta, como o protagonista é chamado?', 'Auto'),
(8, 'Qual a cor marcante do vestido de Kim Novak em Vertigo?', 'Auto'),
(9, 'O que Hitchcock costumava fazer em quase todos os filmes?', 'Auto'),
(10, 'Qual filme explora obsessão e uma espiral visual famosa?', 'Auto'),
(11, 'Em Psicose, que imagem se sobrepõe ao rosto da mãe no final?', 'Auto'),
(12, 'Qual cidade é cenário chave em Um Corpo que Cai?', 'Auto'),
(13, 'Que efeito sonoro marca a cena do chuveiro em Psicose?', 'Auto'),
(14, 'Qual destes NÃO é filme de Hitchcock?', 'Auto'),
(15, 'Qual filme ocorre majoritariamente em um bote salva-vidas?', 'Auto'),
(16, 'Qual o primeiro nome do assassino em Psicose?', 'Auto'),
(17, 'Em Os Pássaros, onde ocorrem os ataques principais?', 'Auto'),
(18, 'Qual profissão tem o protagonista em Intriga Internacional?', 'Auto'),
(19, 'Tema recorrente: o inocente o quê?', 'Auto'),
(20, 'Qual filme tem a famosa cena no campanário (torre)?', 'Auto')
ON DUPLICATE KEY UPDATE texto_pergunta = VALUES(texto_pergunta);

-- Inserts na tabela respostas
INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES
-- 1
(1, 'Psicose', 1),
(1, 'Os Pássaros', 0),
(1, 'Janela Indiscreta', 0),
(1, 'Festim Diabólico', 0),
-- 2
(2, 'Bates Motel', 1),
(2, 'Motel California', 0),
(2, 'Pine View Inn', 0),
(2, 'Roadside Lodge', 0),
-- 3
(3, 'Janet Leigh', 1),
(3, 'Grace Kelly', 0),
(3, 'Kim Novak', 0),
(3, 'Tippi Hedren', 0),
-- 4
(4, 'Bandos de pássaros', 1),
(4, 'Tempestades', 0),
(4, 'Insetos gigantes', 0),
(4, 'Lobos', 0),
-- 5
(5, 'Janela Indiscreta', 1),
(5, 'Ladrão de Casaca', 0),
(5, 'Psicose', 0),
(5, 'Sabotador', 0),
-- 6
(6, 'Intriga Internacional', 1),
(6, 'Os Pássaros', 0),
(6, 'Cortina Rasgada', 0),
(6, 'Topázio', 0),
-- 7
(7, 'Jeff', 1),
(7, 'Ray', 0),
(7, 'Sam', 0),
(7, 'Bob', 0),
-- 8
(8, 'Verde', 1),
(8, 'Vermelho', 0),
(8, 'Preto', 0),
(8, 'Azul', 0),
-- 9
(9, 'Aparecer em cameos', 1),
(9, 'Improvisar roteiro', 0),
(9, 'Só câmera na mão', 0),
(9, 'Sempre P&B', 0),
-- 10
(10, 'Um Corpo que Cai', 1),
(10, 'Festim Diabólico', 0),
(10, 'Marni', 0),
(10, 'Os 39 Degraus', 0),
-- 11
(11, 'Crânio sobreposto', 1),
(11, 'Faca flutuante', 0),
(11, 'Espelho quebrado', 0),
(11, 'Máscara', 0),
-- 12
(12, 'São Francisco', 1),
(12, 'Chicago', 0),
(12, 'Boston', 0),
(12, 'Seattle', 0),
-- 13
(13, 'Violinos estridentes', 1),
(13, 'Silêncio total', 0),
(13, 'Ecos reversos', 0),
(13, 'Piano suave', 0),
-- 14
(14, 'O Iluminado', 1),
(14, 'Psicose', 0),
(14, 'Os Pássaros', 0),
(14, 'Janela Indiscreta', 0),
-- 15
(15, 'Lifeboat', 1),
(15, 'Cidadão Kane', 0),
(15, 'Náufragos', 0),
(15, 'Mar em Fúria', 0),
-- 16
(16, 'Norman', 1),
(16, 'Edward', 0),
(16, 'Michael', 0),
(16, 'Arthur', 0),
-- 17
(17, 'Bodega Bay', 1),
(17, 'Long Island', 0),
(17, 'Monterey', 0),
(17, 'Santa Cruz', 0),
-- 18
(18, 'Publicitário', 1),
(18, 'Professor', 0),
(18, 'Policial', 0),
(18, 'Advogado', 0),
-- 19
(19, 'Acusado injustamente', 1),
(19, 'Magia secreta', 0),
(19, 'Viagem espacial', 0),
(19, 'Lenda grega', 0),
-- 20
(20, 'Um Corpo que Cai', 1),
(20, 'Os Pássaros', 0),
(20, 'Sabotador', 0),
(20, 'Trama Macabra', 0);

INSERT INTO makeoff (nome_arquivo,caminho_arquivo,legenda,autor,grupo) VALUES
("imagem_teste","../../images/making_of/imagem_teste.png","um arquiv para testar","Vinicius","Porta"),
("imagem_teste2","../../images/making_of/imagem_teste2.png","o mesmo do outro","Portes","Porta"),
("imagem_teste3","../../images/birdu.png","o mesmo","Eduardo","Porta"),
("imagem_teste4","../../images/maging_of/imagem_teste3.png","o mesmo","Eduardo","Comida");
