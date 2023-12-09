drop database banco_login_cadastro;
create database banco_login_cadastro;
use banco_login_cadastro;

create table usuario(
id int primary key auto_increment,
nome varchar(255),
email varchar(50) not null,
senha varbinary(12)
);