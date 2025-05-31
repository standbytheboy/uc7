<?php
require_once __DIR__ . '/../model/Produto.php';
require_once __DIR__ . '/../Database.php';

class ProdutoDAO
{
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM produtos");
        
        $produtos = [];
        
        return $produtos;
    }

    public function getById(int $id): ?Produto {
        $stmt = $this->db->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return null;
    }

    public function create(Produto $produto): bool {
        $sql = "INSERT INTO produtos (nome, preco, ativo, dataDeCadastro, dataDeValidade) 
                VALUES (:nome, :preco, :ativo, :dataDeCadastro, :dataDeValidade)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute();
    }

    public function update(Produto $produto): bool {
        $sql = "UPDATE produtos 
                SET nome = :nome, preco = :preco, ativo = :ativo, 
                    dataDeCadastro = :dataDeCadastro, dataDeValidade = :dataDeValidade 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        return true;
    }
}
?>