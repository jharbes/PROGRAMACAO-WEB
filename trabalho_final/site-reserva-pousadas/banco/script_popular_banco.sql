-- Populando a tabela Usuario
INSERT INTO Usuario (id, nome, email, senha) VALUES
(1, 'João Silva', 'joao.silva@email.com', 'senha123'),
(2, 'Maria Oliveira', 'maria.oliveira@email.com', 'senha123'),
(3, 'Carlos Souza', 'carlos.souza@email.com', 'senha123'),
(4, 'Ana Santos', 'ana.santos@email.com', 'senha123'),
(5, 'Pedro Costa', 'pedro.costa@email.com', 'senha123');

-- Populando a tabela Pousada
INSERT INTO Pousada (id, nome, localizacao, descricao) VALUES
(1, 'Pousada Recanto', 'Rua Sol, 123', 'Pousada aconchegante com vista para o mar'),
(2, 'Pousada Sonho Azul', 'Rua das Flores, 456', 'Pousada em meio à natureza'),
(3, 'Hotel Vale Verde', 'Estrada da Serra, 789', 'Pousada rústica na montanha'),
(4, 'Hotel Salinas', 'Avenida dos Lagos, 321', 'Tranquilidade e conforto junto ao lago'),
(5, 'Hotel Saint Moritz', 'Rua das Estrelas, 654', 'Conforto e modernidade com vista para o céu');

-- Populando a tabela FuncionarioPousada
INSERT INTO FuncionarioPousada (id, nome, email, senha, fk_idpousada) VALUES
(1, 'Roberto Lima', 'roberto.lima@email.com', 'senha123', 1),
(2, 'Fernanda Gomes', 'fernanda.gomes@email.com', 'senha123', 2),
(3, 'Ricardo Nunes', 'ricardo.nunes@email.com', 'senha123', 3),
(4, 'Juliana Menezes', 'juliana.menezes@email.com', 'senha123', 4),
(5, 'Lucas Martins', 'lucas.martins@email.com', 'senha123', 5);

-- Populando a tabela Quarto
INSERT INTO Quarto (id, tipo, preco_noite, disponibilidade, fk_idpousada) VALUES
(1, 'casal', 200.00, true, 1),
(2, 'solteiro', 150.00, true, 1),
(3, 'casal', 250.00, false, 2),
(4, 'solteiro', 180.00, true, 2),
(5, 'casal', 300.00, true, 3);

-- Populando a tabela Reserva
INSERT INTO Reserva (id, valor, data_pagamento, status, data_checkin, data_checkout, fk_idquarto, fk_idusuario) VALUES
(1, 400.00, '2023-01-15', 'confirmada', '2023-01-20', '2023-01-22', 1, 1),
(2, 150.00, '2023-02-10', 'solicitada', '2023-02-15', '2023-02-16', 2, 2),
(3, 500.00, '2023-03-05', 'confirmada', '2023-03-10', '2023-03-12', 3, 3),
(4, 360.00, '2023-04-20', 'solicitada', '2023-04-25', '2023-04-27', 4, 4),
(5, 600.00, '2023-05-15', 'confirmada', '2023-05-20', '2023-05-22', 5, 5);

-- Populando a tabela Avaliacao
INSERT INTO Avaliacao (id, nota, comentario, fk_idusuario, fk_idpousada) VALUES
(1, 4.5, 'Excelente pousada, vista maravilhosa!', 1, 1),
(2, 3.8, 'Bom atendimento, mas o quarto era um pouco pequeno.', 2, 2),
(3, 4.2, 'Ótima localização e serviço.', 3, 3),
(4, 3.5, 'Confortável, mas esperava mais.', 4, 4),
(5, 4.8, 'Experiência incrível, recomendo!', 5, 5);

-- Populando a tabela Pagamento
INSERT INTO Pagamento (id, tipo, valor, data, status, codigo_barras, numero_cartao, validade_cartao, cvv, nome_titular, chave_pix, fk_idreserva) VALUES
(1, 'cartao_credito', 400.00, '2023-01-15', 'pago', NULL, '1111222233334444', '12/2025', '123', 'João Silva', NULL, 1),
(2, 'boleto', 150.00, '2023-02-10', 'pendente', '123456789101112', NULL, NULL, NULL, NULL, NULL, 2),
(3, 'PIX', 500.00, '2023-03-05', 'pago', NULL, NULL, NULL, NULL, NULL, '123.456.789-00', 3),
(4, 'cartao_debito', 360.00, '2023-04-20', 'pago', NULL, '4444333322221111', '11/2024', '321', 'Ana Santos', NULL, 4),
(5, 'cartao_credito', 600.00, '2023-05-15', 'pago', NULL, '5555666677778888', '10/2023', '456', 'Pedro Costa', NULL, 5);
