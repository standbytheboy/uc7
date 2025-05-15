<?php
require 'Pizza.php';
require 'Database.php';

class PizzaDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getBd();
    }

    public function getPizzas()
    {        
        $stmt = $this->db->query("SELECT * FROM pizza");
        $pizzas = [];

        while ($row = $stmt->fetch((PDO::FETCH_ASSOC))) {
            $pizzas[] = new Pizza(
                $row['id'],
                $row['sabor'],
                $row['tamanho'],
                $row['preco']
            );
        }
        return $pizzas;
    }

    public function addPizza(Pizza $pizza) {
        $stmt = $this->db->prepare( 'INSERT INTO pizza (sabor, tamanho, preco) values (:sabor, :tamanho, :preco)'); // dois pontos indica que ainda vou colocar um dado nessa query

        $sabor = $pizza->getSabor();
        $tamanho = $pizza->getTamanho();
        $preco = $pizza->getPreco();
        $stmt->bindParam(':sabor', $sabor);
        $stmt->bindParam(':tamanho', $tamanho);
        $stmt->bindParam(':preco', $preco);
        $stmt->execute();
    }
}
