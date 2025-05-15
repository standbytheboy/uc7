create database if not exists agenda;
use agenda;
 
create table if not exists contatos (
	id int auto_increment primary key,
    nome varchar(100) not null
);