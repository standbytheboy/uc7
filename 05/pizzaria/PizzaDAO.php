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

    public function getAll()
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

    public function getById(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM pizza WHERE id = :id");
        $stmt->bindParam("id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Pizza($row["id"], $row["sabor"], $row["tamanho"], $row["preco"]) : null;
    }

    public function create(Pizza $pizza) {
        $stmt = $this->db->prepare( 'INSERT INTO pizza (sabor, tamanho, preco) values (:sabor, :tamanho, :preco)'); // dois pontos indica que ainda vou colocar um dado nessa query

        $sabor = $pizza->getSabor();
        $tamanho = $pizza->getTamanho();
        $preco = $pizza->getPreco();
        $stmt->bindParam(':sabor', $sabor);
        $stmt->bindParam(':tamanho', $tamanho);
        $stmt->bindParam(':preco', $preco);
        $stmt->execute();
    }

    public function update(Pizza $pizza) { 
        $sql = "UPDATE pizza SET sabor = :sabor, tamanho = :tamanho, preco = :preco";

        $id = $pizza->getId();
        $sabor = $pizza->getSabor();
        $tamanho = $pizza->getTamanho();
        $preco = $pizza->getPreco();

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("sabor", $sabor);
        $stmt->bindParam("tamanho", $tamanho);
        $stmt->bindParam("preco", $preco);
        $stmt->execute();
    }

    public function delete(int $id) { 
        $stmt = $this->db->prepare("DELETE FROM pizza WHERE id = :id");
        $stmt->bindParam("id", $id);
        $stmt->execute();
    }
}
