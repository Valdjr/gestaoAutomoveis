create database veiculos;
use veiculos;

drop table if exists opcional;
drop table if exists marca;
drop table if exists veiculo;
drop table if exists veiculo_opcional;

CREATE TABLE `opcional` (
    `id` int not null auto_increment PRIMARY KEY,
    `descricao` varchar(100) NOT NULL,
    INDEX `pk_opcional` (`id`)
)
;

CREATE TABLE `marca` (
    `id` int(11) not null auto_increment PRIMARY KEY,
    descricao varchar(20),
    INDEX `pk_marca` (`id`)
)
;

CREATE TABLE `veiculo` (
	id int not null auto_increment PRIMARY KEY,
    descricao varchar(60) not null,
    placa varchar(7) not null,
    codigoRenavam varchar(11) not null,
    anoModelo int(4) not null,
    anoFabricacao int(4) not null,
    cor varchar(20) not null,
    km int(6) not null,
    `marca` int(11),
    preco double(8,2) not null,
    precoFipe double(8,2) not null,
    INDEX `pk_veiculo` (`id`),
    INDEX `fk_marca_veiculo` (`marca`),
    CONSTRAINT `fk_marca_veiculo` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON DELETE SET NULL
)
;

CREATE TABLE `veiculo_opcional` (
    `idVeiculo` INT(11) NOT NULL,
    `idOpcional` INT(11) NOT NULL,
    INDEX `fk_veiculo_vo` (`idVeiculo`),
    INDEX `fk_opcional_vo` (`idOpcional`),
    CONSTRAINT `fk_veiculo_vo` FOREIGN KEY (`idVeiculo`) REFERENCES `veiculo` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_opcional_vo` FOREIGN KEY (`idOpcional`) REFERENCES `opcional` (`id`) ON DELETE CASCADE
)
;


