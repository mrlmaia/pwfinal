
DROP DATABASE roteiro13;

CREATE DATABASE roteiro13;

USE roteiro13;

CREATE TABLE tbTipo
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE tbMorador
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   cpf                  VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE tbRepublica
(
   id                   INT NOT NULL AUTO_INCREMENT,
   nome                 VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE tbConta
(
   id                   INT NOT NULL AUTO_INCREMENT,
   mes                  VARCHAR(255) NOT NULL,
   valor                NUMERIC(9,2) NOT NULL,
   idTipo               INT NOT NULL,
   idRepublica         INT NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE tbRateio
(
   id                   INT NOT NULL AUTO_INCREMENT,
   valor                NUMERIC(9,2) NOT NULL,
   situacao             INT NOT NULL,
   idMorador            INT NOT NULL,
   idConta              INT NOT NULL,
   PRIMARY KEY (id)
);

ALTER TABLE tbRateio ADD CONSTRAINT FK_Rateio_Morador FOREIGN KEY (idMorador)
      REFERENCES tbMorador (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbRateio ADD CONSTRAINT FK_Rateio_Conta FOREIGN KEY (idConta)
      REFERENCES tbConta (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbConta ADD CONSTRAINT FK_Conta_Tipo FOREIGN KEY (idTipo)
      REFERENCES tbTipo (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE tbConta ADD CONSTRAINT FK_Conta_Republica FOREIGN KEY (idRepublica)
      REFERENCES tbRepublica (id) ON DELETE RESTRICT ON UPDATE RESTRICT;
	  
CREATE TABLE tbProduto
(
   id                   INT NOT NULL AUTO_INCREMENT,
   descricao            VARCHAR(255) NOT NULL,
   valor	               NUMERIC(9,2) NOT NULL,
   quantidade           INT NOT NULL,   
   PRIMARY KEY (id)
);	  


INSERT INTO tbProduto(id, descricao, valor, quantidade) VALUES(1, 'Notebook i7', 3134.87, 10);
INSERT INTO tbProduto(id, descricao, valor, quantidade) VALUES(2, 'Cadeira Presidente', 350.00, 4);
INSERT INTO tbProduto(id, descricao, valor, quantidade) VALUES(3, 'Notebook i3', 1513.85, 5);
INSERT INTO tbProduto(id, descricao, valor, quantidade) VALUES(4, 'Mouse', 50.80, 8);

INSERT INTO tbRepublica(id, nome) VALUES(1, 'Casa do Programador');

INSERT INTO tbTipo(id, nome) VALUES(1, 'COPASA');
INSERT INTO tbTipo(id, nome) VALUES(2, 'CEMIG');
INSERT INTO tbTipo(id, nome) VALUES(3, 'ALUGUEL');

INSERT INTO tbMorador(id, nome, cpf) VALUES(1, 'Joao', '111.111.111-11');
INSERT INTO tbMorador(id, nome, cpf) VALUES(2, 'Pedro', '222.222.222-22');
INSERT INTO tbMorador(id, nome, cpf) VALUES(3, 'Paulo', '333.333.333-33');

INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(1, 'janeiro', 120.00, 1, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(1, 40.00, 1, 1, 1);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(2, 40.00, 1, 2, 1);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(3, 40.00, 1, 3, 1);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(2, 'janeiro', 180.00, 2, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(4, 60.00, 1, 1, 2);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(5, 60.00, 1, 2, 2);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(6, 60.00, 1, 3, 2);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(3, 'janeiro', 600.00, 3, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(7, 200.00, 1, 1, 3);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(8, 200.00, 1, 2, 3);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(9, 200.00, 1, 3, 3);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(4, 'fevereiro', 90.00, 1, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(10, 30.00, 1, 1, 4);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(11, 30.00, 1, 2, 4);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(12, 30.00, 1, 3, 4);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(5, 'fevereiro', 150.00, 2, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(13, 50.00, 1, 1, 5);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(14, 50.00, 1, 2, 5);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(15, 50.00, 1, 3, 5);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(6, 'fevereiro', 600.00, 3, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(16, 200.00, 1, 1, 6);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(17, 200.00, 1, 2, 6);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(18, 200.00, 0, 3, 6);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(7, 'marco', 150.00, 1, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(19, 75.00, 1, 1, 7);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(20, 75.00, 1, 2, 7);


INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(8, 'marco', 210.00, 2, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(21, 105.00, 1, 1, 8);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(22, 105.00, 1, 2, 8);

INSERT INTO tbConta(id, mes, valor, idTipo, idRepublica) VALUES(9, 'marco', 600.00, 3, 1);

INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(23, 300.00, 0, 1, 9);
INSERT INTO tbRateio(id, valor, situacao, idMorador, idConta) VALUES(24, 300.00, 0, 2, 9);
