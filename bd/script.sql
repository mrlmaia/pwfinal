drop schema if exists `trabalhoFinalPW`;
CREATE SCHEMA IF NOT EXISTS `trabalhoFinalPW` DEFAULT CHARACTER SET utf8 ;
USE `trabalhoFinalPW` 

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
(3,'Morango Bandeija', 3, 10),
(4,'Leite moca', 3.5, 11),
(5,'Coco ralado 10g', 0.3, 15);

drop table if exists TbReceita;
CREATE TABLE IF NOT EXISTS `TbReceita` (
  `id` INT NOT NULL AUTO_INCREMENT,
  nome varchar(45) not null,
  rendimento decimal(10,2),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

insert into TbReceita values
(1,'RCC Chocolate', 1),
(2, 'RCC Morango', 1),
(3,'RCC Coco', 1);

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

insert into TbProduto(nome, precoCusto, precoVenda, quantidade, idReceita) values 
('CC Chocolate', 1.56, 3, 5, 1),
('CC Blue Ice', null, 2, 7, null), 
('CC Morango', 1.29, 2.5, 6, 2),
('CC Coco', 1.08, 2.5, 3, 3);

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
(1,2,30),
(2,1,0.3),
(2, 3, 0.25),
(3,5,1.5),
(3, 1, 0.35);

drop table if exists TbProducao;
create table if not exists TbProducao(
	id int not null auto_increment,
    dia varchar(2) not null,
    mes varchar(10) not null,
    ano varchar(4) not null,
    gastoTotal decimal(10,2) not null,
    primary key (id));
insert into TbProducao values
(null, 23, 'janeiro', 2019,);    

drop table TbProducaoProduto;
create table if not exists TbProducaoProduto(
	id int not null auto_increment,
	idProduto int not null,
    idProducao int not null,
    qtdProduto int not null,
    primary key (id),
    foreign key (idProduto) references TbProduto(id),
    foreign key (idProducao) references TbProducao(id));
   