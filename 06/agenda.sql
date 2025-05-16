create database if not exists agenda;
use agenda;
 
create table if not exists contatos (
	id int auto_increment primary key,
    nome varchar(100) not null,
    telefone varchar(15) not null,
    email varchar(100) not null,
    endereco varchar(255)
);

insert into contatos (nome, telefone, email, endereco) values
('Mickey', '1199988777', 'mickey@mail.com', 'Rua X, Disney'),
('Donald', '1199558777', 'donald@mail.com', 'Ladeira Z, Disney'),
('Margarida', '1129988077', 'margarida@mail.com', 'Avenida Y, Disney');

insert into contatos (nome, telefone, email) values
('Batman', '1192284477', 'batman@mail.com');