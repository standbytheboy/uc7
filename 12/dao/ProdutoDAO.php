<?php
require_once __DIR__ . '/../model/Produto.php';
require_once __DIR__ . '/../model/Fornecedor.php';
require_once __DIR__ . '/../core/Database.php';

class ProdutoDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {  // estamos instanciando o fornecedor junto pois precisamos dele para instanciar um produto também
        $stmt = $this->db->query(
            "SELECT p.*, 
            f.id AS fornecedor_id,
            f.nome AS fornecedor_nome,
            f.cnpj AS fornecedor_cnpj,
            f.contato AS fornecedor_contato
            FROM produtos p 
            LEFT JOIN fornecedores f
            ON p.fornecedor_id = f.id"
        );
        
        $produtosData = $stmt->fetchAll();
        $produtos = [];
        
        foreach ($produtosData as $data) {
            $fornecedor = null;
            if(isset($data['fornecedor_id']))
            {
                $fornecedor = new Fornecedor(
                    $data['fornecedor_id'],
                    $data['fornecedor_nome'],
                    $data['fornecedor_cnpj'],
                    $data['fornecedor_contato']
                );
            }

            $produtos[] = new Produto(
                $data['id'],
                $data['nome'],
                (float)$data['preco'],
                (bool)$data['ativo'],
                $data['dataDeCadastro'],
                $data['dataDeValidade'],
                $fornecedor
            );
        }
        return $produtos;
    }

    public function getById(int $id): ?Produto
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, 
                    f.id AS fornecedor_id, 
                    f.nome AS fornecedor_nome,
                    f.cnpj AS fornecedor_cnpj,
                    f.contato AS fornecedor_contato
            FROM produtos p 
            LEFT JOIN fornecedores f
            ON p.fornecedor_id = f.id
            WHERE p.id = :id" // Make sure to specify 'p.id' for clarity
        );
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as associative array for easier access

        if ($data) {
            $fornecedor = null;
            // Check if supplier data exists (i.e., if the LEFT JOIN found a match)
            if ($data['fornecedor_id']) { 
                $fornecedor = new Fornecedor(
                    $data['fornecedor_id'],
                    $data['fornecedor_nome'],
                    $data['fornecedor_cnpj'],
                    $data['fornecedor_contato']
                );
            }

            return new Produto(
                $data['id'],
                $data['nome'],
                (float)$data['preco'],
                (bool)$data['ativo'],
                $data['dataDeCadastro'],
                $data['dataDeValidade'],
                $fornecedor // Pass the Fornecedor object here
            );
        }
        return null;
    }

    public function create(Produto $produto): bool
    {
        $sql = "INSERT INTO produtos (nome, preco, ativo, dataDeCadastro, dataDeValidade, fornecedor_id) 
                VALUES (:nome, :preco, :ativo, :dataDeCadastro, :dataDeValidade, :fornecedor_id)";
        $stmt = $this->db->prepare($sql);

        $fornecedorId = $produto->getFornecedor() ? $produto->getFornecedor()->getId() : null;

        return $stmt->execute([
            ':nome' => $produto->getNome(),
            ':preco' => $produto->getPreco(),
            ':ativo' => $produto->getAtivo() ? 1 : 0,
            ':dataDeCadastro' => $produto->getDataDeCadastro(),
            ':dataDeValidade' => $produto->getDataDeValidade(),
            ':fornecedor_id' => $fornecedorId
        ]);
    }

    public function update(Produto $produto): bool
    {
        $sql = "UPDATE produtos 
                SET nome = :nome, preco = :preco, ativo = :ativo, 
                    dataDeCadastro = :dataDeCadastro, dataDeValidade = :dataDeValidade, 
                    fornecedor_id = :fornecedor_id
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $fornecedorId = $produto->getFornecedor() ? $produto->getFornecedor()->getId() : null;

        return $stmt->execute([
            ':id' => $produto->getId(),
            ':nome' => $produto->getNome(),
            ':preco' => $produto->getPreco(),
            ':ativo' => $produto->getAtivo() ? 1 : 0,
            ':dataDeCadastro' => $produto->getDataDeCadastro(),
            ':dataDeValidade' => $produto->getDataDeValidade(),
            ':fornecedor_id' => $fornecedorId
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Alternativa
        return $stmt->execute([':id' => $id]);
    }
}
?>