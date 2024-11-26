
CREATE DATABASE GerenciamentoChamados;
USE GerenciamentoChamados;


CREATE TABLE Cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100) NOT NULL,
    email_cliente VARCHAR(100) NOT NULL UNIQUE,
    telefone_cliente VARCHAR(15) NOT NULL
);


CREATE TABLE Colaborador (
    id_colaborador INT AUTO_INCREMENT PRIMARY KEY,
    nome_colaborador VARCHAR(100) NOT NULL,
    email_colaborador VARCHAR(100) NOT NULL UNIQUE
);


CREATE TABLE Chamado (
    id_chamado INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_colaborador INT DEFAULT NULL,
    descricao_chamado TEXT NOT NULL,
    criticidade ENUM('baixa', 'média', 'alta') NOT NULL,
    status_chamado ENUM('aberto', 'em andamento', 'resolvido') DEFAULT 'aberto',
    data_abertura DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_colaborador) REFERENCES Colaborador(id_colaborador) ON DELETE SET NULL
);
