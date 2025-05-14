CREATE DATABASE IF NOT EXISTS pizzaria_senac;
USE pizzaria_senac;
 
CREATE TABLE IF NOT EXISTS pizza (
	id INT AUTO_INCREMENT PRIMARY KEY,
	sabor VARCHAR(100) NOT NULL,
    tamanho VARCHAR(10) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL
);

-- INSERÇÃO DE DADOS:
INSERT INTO pizza (sabor, tamanho, preco) VALUES ('Calabresa', 'Grande', 39.90);
INSERT INTO pizza (sabor, tamanho, preco) VALUES ('Margherita', 'Média', 32.50);
INSERT INTO pizza (sabor, tamanho, preco) VALUES ('Quatro Queijos', 'Grande', 42.00);
INSERT INTO pizza (sabor, tamanho, preco) VALUES ('Frango com Catupiry', 'Pequena', 28.00);
INSERT INTO pizza (sabor, tamanho, preco) VALUES ('Portuguesa', 'Média', 35.00);
