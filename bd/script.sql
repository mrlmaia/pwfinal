CREATE SCHEMA IF NOT EXISTS `trabalhoFinalPW` DEFAULT CHARACTER SET utf8 ;
USE `trabalhoFinalPW` ;

drop table if exists TbIngrediente;
CREATE TABLE if not exists TbIngrediente (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  preco decimal(13,2) NOT NULL,
  quantidade integer NOT NULL,
  PRIMARY KEY (id));
  
insert into TbIngrediente values 
(1,'leite 1L', 1.8, 20),
(2,'Chocolate g', 0.04, 2000),
(3,'Morango Bandeija', 3, 10);

drop table if exists TbReceita;
CREATE TABLE IF NOT EXISTS `TbReceita` (
  `id` INT NOT NULL AUTO_INCREMENT,
  nome varchar(45) not null,
  rendimento decimal(10,2),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

insert into TbReceita values
(1,'RCC Chocolate', 5),
(2, 'RCC Morango', 3);

drop table if exists TbProduto;
CREATE TABLE if not exists `TbProduto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `precoCusto` decimal(10,2),
  `precoVenda` DECIMAL(10,2),
  quantidade decimal(10,2),
  idReceita int,
  PRIMARY KEY (`id`),
  foreign key (idReceita) references TbReceita(id) on delete set null
);

insert into TbProduto(nome, precoVenda, quantidade) values 
('CC Chocolate', 2.5, 5), 
('CC Morango', 2.5, 6);

drop table if exists TbReceitaIngrediente;
create table if not exists TbReceitaIngrediente(
	idReceita int not null,
    idIngrediente int not null,
    qtdIngrediente decimal(10,2) not null,
    primary key (idReceita, idIngrediente),
    foreign key (idReceita) references TbReceita(id),
    foreign key (idIngrediente) references TbIngrediente(id));

insert into TbReceitaIngrediente values
(1,1,0.2),
(1,2,70),
(2,1,0.3),
(2, 3, 0.25);

-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
-- select r.id, r.nome, i.id, i.nome, qtdIngrediente as qtd from TbReceita r, TbReceitaIngrediente ri, TbIngrediente i where r.id = ri.idReceita and i.id = ri.idIngrediente;