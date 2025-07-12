drop database if exists sispapelaria;

create database sispapelaria;

use sispapelaria;

-- select * from produto; --

create table categoria (idcategoria INT AUTO_INCREMENT PRIMARY KEY, nomecategoria VARCHAR(255));

create table marca (idmarca INT AUTO_INCREMENT PRIMARY KEY, nomemarca VARCHAR(255));

create table cliente (idcliente INT AUTO_INCREMENT PRIMARY KEY, nomecliente VARCHAR(255), enderecocliente VARCHAR(255), emailcliente VARCHAR(255),
nasccliente DATE, telefonecliente VARCHAR(16));

create table fornecedor (idfornecedor INT AUTO_INCREMENT PRIMARY KEY, cnpjfornecedor VARCHAR(18), nomefornecedor VARCHAR(255), enderecofornecedor TEXT, telefonefornecedor VARCHAR(16),
emailfornecedor VARCHAR(255));

create table produto (idproduto INT AUTO_INCREMENT PRIMARY KEY, nomeproduto VARCHAR(255), categoriaproduto INT,  marcaproduto INT, precoproduto DECIMAL(10,2), qtproduto SMALLINT,
FOREIGN KEY (categoriaproduto) REFERENCES categoria (idcategoria), FOREIGN KEY (marcaproduto) REFERENCES marca (idmarca));

create table venda (idvenda INT AUTO_INCREMENT PRIMARY KEY, idproduto INT, qtvproduto SMALLINT, datavenda DATE, descontoproduto TINYINT,
precovenda DECIMAL(10,2), idcliente INT, FOREIGN KEY (idproduto) REFERENCES produto (idproduto), FOREIGN KEY (idcliente) REFERENCES cliente (idcliente));

create table compra (idcompra INT AUTO_INCREMENT PRIMARY KEY, idproduto INT, qtcproduto SMALLINT, datacompra DATE, idfornecedor INT, 
FOREIGN KEY (idproduto) REFERENCES produto (idproduto), FOREIGN KEY (idfornecedor) REFERENCES fornecedor (idfornecedor));
