<?php
require 'Pizza.php';
class Database {
    public function getAll() {
        $db = new PDO("mysql:host=localhost;dbname=pizzaria_senac", 'root', '');
        $stmt = $db->query("SELECT * FROM pizza");
        $pizzas = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pizzas = new Pizza($row['id'], $row['sabor'], $row['tamanho'], $row['preco']);
        }
        
        return $pizzas;
    }
}