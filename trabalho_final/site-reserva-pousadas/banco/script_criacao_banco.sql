/* diagrama_entidade_relacionamento_logico: */

CREATE TABLE Usuario (
    id int PRIMARY KEY,
    nome varchar(25),
    email varchar(25),
    senha varchar(15)
);

CREATE TABLE Avaliacao (
    id int PRIMARY KEY,
    nota float(3,1),
    comentario varchar(255),
    fk_idusuario int,
    fk_idpousada int
);

CREATE TABLE Pousada (
    id int PRIMARY KEY,
    nome varchar(25),
    localizacao varchar(100),
    descricao varchar(255)
);

CREATE TABLE FuncionarioPousada (
    id int PRIMARY KEY,
    nome varchar(25),
    email varchar(25),
    senha varchar(15),
    fk_idpousada int
);

CREATE TABLE Quarto (
    id int PRIMARY KEY,
    tipo enum('solteiro','casal'),
    preco_noite float(10,2),
    disponibilidade boolean,
    fk_idpousada int
);

CREATE TABLE Reserva (
    id int PRIMARY KEY,
    valor float(10,2),
    data_pagamento date,
    status enum('solicitada','confirmada'),
    data_checkin date,
    data_checkout date,
    fk_idquarto int,
    fk_idusuario int
);

CREATE TABLE Pagamento (
    id int PRIMARY KEY,
    tipo enum('solteiro','casal'),
    valor float(10,2),
    data date,
    status enum('pendente','confirmado'),
    codigo_barras char(48),
    numero_cartao char(16),
    validade_cartao char(4),
    cvv_cartao char(3),
    nome_cartao varchar(15),
    chave_pix varchar(50),
    fk_idreserva int
);
 
ALTER TABLE Avaliacao ADD CONSTRAINT FK_Avaliacao_2
    FOREIGN KEY (fk_Usuario_id)
    REFERENCES Usuario (id)
    ON DELETE CASCADE;
 
ALTER TABLE Avaliacao ADD CONSTRAINT FK_Avaliacao_3
    FOREIGN KEY (fk_Pousada_id)
    REFERENCES Pousada (id)
    ON DELETE CASCADE;
 
ALTER TABLE Avaliacao ADD CONSTRAINT FK_Avaliacao_4
    FOREIGN KEY (fk_idusuario???, fk_idpousada???)
    REFERENCES ??? (???);
 
ALTER TABLE FuncionarioPousada ADD CONSTRAINT FK_FuncionarioPousada_2
    FOREIGN KEY (fk_Pousada_id)
    REFERENCES Pousada (id)
    ON DELETE RESTRICT;
 
ALTER TABLE FuncionarioPousada ADD CONSTRAINT FK_FuncionarioPousada_3
    FOREIGN KEY (fk_idpousada???)
    REFERENCES ??? (???);
 
ALTER TABLE Quarto ADD CONSTRAINT FK_Quarto_2
    FOREIGN KEY (fk_Pousada_id)
    REFERENCES Pousada (id)
    ON DELETE RESTRICT;
 
ALTER TABLE Quarto ADD CONSTRAINT FK_Quarto_3
    FOREIGN KEY (fk_idpousada???)
    REFERENCES ??? (???);
 
ALTER TABLE Reserva ADD CONSTRAINT FK_Reserva_2
    FOREIGN KEY (fk_idusuario, fk_idquarto???, fk_idpagamento???)
    REFERENCES Usuario (id, ???, ???);
 
ALTER TABLE Reserva ADD CONSTRAINT FK_Reserva_3
    FOREIGN KEY (fk_Quarto_id, fk_Quarto_fk_idpousada???)
    REFERENCES Quarto (id, ???);
 
ALTER TABLE Pagamento ADD CONSTRAINT FK_Pagamento_2
    FOREIGN KEY (fk_idreserva???)
    REFERENCES ??? (???);