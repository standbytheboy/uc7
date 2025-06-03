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
        $produtosData = $stmt->fetchAll(); // setando o fetchAll para não ter que declarar diversas vezes depois, ou na linha acima
        $produtos = [];
        foreach($produtosData as $data) {
            $produtos[] = new Produto($data['nome'], $data['preco'], $data['ativo'], $data['dataDeCadastro'], $data['dataDeValidade']);
        }
        
        return $produtos;
    }

    public function getById(int $id): ?Produto {
        $stmt = $this->db->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch();
        if($data) {
            return new Produto($data['id'], $data['nome'], $data['preco'], $data['ativo'], $data['dataDeCadastro'], $data['dataDeValidade']);
        }
        
        return null;
    }

    public function create(Produto $produto): bool {
        $sql = "INSERT INTO produtos (nome, preco, ativo, dataDeCadastro, dataDeValidade) 
                VALUES (:nome, :preco, :ativo, :dataDeCadastro, :dataDeValidade)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(
            [
                ':nome' => $produto->getNome(),
                ':cpf' => $produto->getPreco(),
                ':ativo' => $produto->getAtivo() ? 1 : 0,
                ':dataDeCadastro' => $produto->getDataDeCadastro(),
                ':dataDeValidade' => $produto->getDataDeValidade()
            ]
        );
    }

    public function update(Produto $produto): bool {
        $sql = "UPDATE produtos 
                SET nome = :nome, preco = :preco, ativo = :ativo, 
                    dataDeCadastro = :dataDeCadastro, dataDeValidade = :dataDeValidade 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(
            [
                ':id' => $produto->getId(),
                ':nome' => $produto->getNome(),
                ':cpf' => $produto->getPreco(),
                ':ativo' => $produto->getAtivo() ? 1 : 0,
                ':dataDeCadastro' => $produto->getDataDeCadastro(),
                ':dataDeValidade' => $produto->getDataDeValidade()
            ]
        );
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>