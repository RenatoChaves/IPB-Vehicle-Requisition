CREATE SCHEMA reqveicdb;

CREATE TABLE unidadeOrganica(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	unidadeOrganica VARCHAR(45) NOT NULL UNIQUE
);

CREATE TABLE marca(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	marca VARCHAR(45) NOT NULL UNIQUE
);

CREATE TABLE tipoCombustivel(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	tipo VARCHAR(45) NOT NULL UNIQUE
);

CREATE TABLE disponibilidade(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	estado VARCHAR(45) NOT NULL UNIQUE
);

CREATE TABLE modelo(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	modelo VARCHAR(45) NOT NULL UNIQUE,
	marca_id INT NOT NULL,
	CONSTRAINT fk_modelo_marca
	FOREIGN KEY (marca_id)
	REFERENCES marca (id)
);

CREATE TABLE veiculo(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	matricula VARCHAR(45) NOT NULL UNIQUE,
	cor VARCHAR(45) NOT NULL,
	capacidade_bagageira VARCHAR(45) NOT NULL,
	lugares VARCHAR(45) NOT NULL,
	modelo_id INT NOT NULL,
	tipoCombustivel_id INT NOT NULL,
	disponibilidade_id INT NOT NULL,
	CONSTRAINT fk_veiculo_modelo FOREIGN KEY (modelo_id) REFERENCES modelo (id),
	CONSTRAINT fk_veiculo_tipoCombustivel FOREIGN KEY (tipoCombustivel_id) REFERENCES tipoCombustivel (id),
	CONSTRAINT fk_veiculo_disponibilidade FOREIGN KEY (disponibilidade_id) REFERENCES disponibilidade (id)
);

CREATE TABLE utilizador(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45) NOT NULL,
	apelido VARCHAR(45) NOT NULL,
	numeroBI VARCHAR(45) NOT NULL UNIQUE,
	numeroMecanografico VARCHAR(45) NOT NULL UNIQUE,
	telemovel VARCHAR(45) NOT NULL UNIQUE,
	unidadeOrganica_id INT NOT NULL,	
	CONSTRAINT fk_utilizador_unidadeOrganica FOREIGN KEY (unidadeOrganica_id) REFERENCES unidadeOrganica (id)
);

CREATE TABLE requisicao(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data_req DATETIME NOT NULL,
	data_submit_req DATETIME NOT NULL,
	data_saida DATETIME NULL,
	data_chegada DATETIME NULL,
	motivo_requisicao VARCHAR(500) NOT NULL,
	km_saida INT NULL,
	km_chegada INT NOT NULL,
	validador VARCHAR(45) NULL,
	utilizador_id INT NOT NULL,
	veiculo_id INT NOT NULL,
	CONSTRAINT fk_requisicao_utilizador FOREIGN KEY (utilizador_id) REFERENCES utilizador (id),
	CONSTRAINT fk_requisicao_veiculo FOREIGN KEY (veiculo_id) REFERENCES veiculo (id)
);

CREATE TABLE manutencao(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data DATETIME NOT NULL,
	km_saida INT NOT NULL,
	km_chegada INT NOT NULL,
	observacoes VARCHAR(500) NOT NULL,
	data_inspecao DATETIME NOT NULL,
	veiculo_id INT NOT NULL,
	requisicao_id INT NOT NULL,
	utilizador_id INT NOT NULL,
	CONSTRAINT fk_manutencao_veiculo FOREIGN KEY (veiculo_id) REFERENCES veiculo (id),
	CONSTRAINT fk_manutencao_requisicao FOREIGN KEY (requisicao_id) REFERENCES requisicao (id),
	CONSTRAINT fk_manutencao_utilizador FOREIGN KEY (utilizador_id) REFERENCES utilizador (id)
);

/* ADICIONAR TABELA (VALIDACAO) */

CREATE TABLE validacao(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
estado VARCHAR(45) NOT NULL UNIQUE
);

/* ADICIONAR CHAVE ESTRANGEIRA DE (VALIDACAO) A (REQUISICAO) */

ALTER TABLE requisicao
ADD validacao_id INT NOT NULL;

ALTER TABLE requisicao
ADD CONSTRAINT fk_requisicao_validacao
FOREIGN KEY (validacao_id)
REFERENCES validacao(id);

CREATE USER 'a40286'@'localhost' IDENTIFIED BY 'a40286';

GRANT ALL PRIVILEGES ON reqveicdb . * TO 'a40286'@'localhost';

/* ALTEREM O USER QUE VÂO CRIAR! E DEPOIS A DB.PHP NO PROJETO

DEPOIS DE TEREM A BASE DE DADOS CRIADA E O RBAC INTEGRADO, CORRAM ESTE CÓDIGO PARA ADICIONAR A CONSTRAINT QUE FALTA PARA OS UTILIZADORES ESTAREM EM SINTONIA COM O RBAC */

ALTER TABLE utilizador
ADD user_id INT NOT NULL;

ALTER TABLE utilizador
ADD CONSTRAINT fk_utilizador_user
FOREIGN KEY (user_id)
REFERENCES user(id);

/* INSERTS tipoCombustivel */

INSERT INTO tipoCombustivel (tipo)
VALUES ("Diesel");

INSERT INTO tipoCombustivel (tipo)
VALUES ("Gasolina");

INSERT INTO tipoCombustivel (tipo)
VALUES ("GPL");

INSERT INTO tipoCombustivel (tipo)
VALUES ("Elétrico");

INSERT INTO tipoCombustivel (tipo)
VALUES ("Híbrido");


/* INSERTS unidadeOrganica */

INSERT INTO unidadeOrganica (unidadeOrganica)
VALUES ("ESTiG");

INSERT INTO unidadeOrganica (unidadeOrganica)
VALUES ("ESE");

INSERT INTO unidadeOrganica (unidadeOrganica)
VALUES ("ESSa");

INSERT INTO unidadeOrganica (unidadeOrganica)
VALUES ("ESA");

INSERT INTO unidadeOrganica (unidadeOrganica)
VALUES ("EsACT");


/* INSERTS disponibilidade */

INSERT INTO disponibilidade (estado)
VALUES ("Disponível");

INSERT INTO disponibilidade (estado)
VALUES ("Em Trânsito");

INSERT INTO disponibilidade (estado)
VALUES ("Indisponível");


/* INSERTS marca */

INSERT INTO marca (marca)
VALUES ("Volkswagen");

INSERT INTO marca (marca)
VALUES ("Opel");

INSERT INTO marca (marca)
VALUES ("Ford");

INSERT INTO marca (marca)
VALUES ("Renault");

INSERT INTO marca (marca)
VALUES ("Citroen");


/* INSERTS modelo ( Volkswagen ) */

INSERT INTO modelo (modelo,marca_id)
VALUES ("Polo" , (
SELECT id FROM marca WHERE marca = "Volkswagen"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Golf", (
SELECT id FROM marca WHERE marca = "Volkswagen"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Passat", (
SELECT id FROM marca WHERE marca = "Volkswagen"));


/* INSERTS modelo ( Opel ) */

INSERT INTO modelo (modelo,marca_id)
VALUES ("Astra", (
SELECT id FROM marca WHERE marca = "Opel"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Insignia", (
SELECT id FROM marca WHERE marca = "Opel"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Corsa", (
SELECT id FROM marca WHERE marca = "Opel"));


/* INSERTS modelo ( Ford ) */

INSERT INTO modelo (modelo,marca_id)
VALUES ("Fiesta", (
SELECT id FROM marca WHERE marca = "Ford"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Puma", (
SELECT id FROM marca WHERE marca = "Ford"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Focus", (
SELECT id FROM marca WHERE marca = "Ford"));


/* INSERTS modelo ( Renault ) */

INSERT INTO modelo (modelo,marca_id)
VALUES ("Zoe", (
SELECT id FROM marca WHERE marca = "Renault"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Clio", (
SELECT id FROM marca WHERE marca = "Renault"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Twingo", (
SELECT id FROM marca WHERE marca = "Renault"));


/* INSERTS modelo ( Citroen ) */

INSERT INTO modelo (modelo,marca_id)
VALUES ("C3", (
SELECT id FROM marca WHERE marca = "Citroen"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("Berlingo", (
SELECT id FROM marca WHERE marca = "Citroen"));

INSERT INTO modelo (modelo,marca_id)
VALUES ("C-Zero", (
SELECT id FROM marca WHERE marca = "Citroen"));


/* INSERTS VALIDACAO */

INSERT INTO validacao (estado)
VALUES ("Aprovada");

INSERT INTO validacao (estado)
VALUES ("Rejeitada");

INSERT INTO validacao (estado)
VALUES ("Pendente");


