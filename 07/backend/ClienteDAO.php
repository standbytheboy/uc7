<?php

require_once 'Cliente.php';
require_once 'Database.php';

class ClienteDAO {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance(); // criando instancia o DB e linkando ao mesmo
    }

    public function getAll(): array {
        $sql = $this->db->query("SELECT * FROM clientes");
        $clientes = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = new Cliente(
                $row["id"],
                $row["nome"],
                $row["cpf"],
                $row["ativo"],
                $row["dataDeNascimento"]
            );
        }
        return $clientes;
    }

    public function getById(int $id): ?Cliente {
        $sql = "SELECT * FROM clientes WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row? new Cliente(
            $row["id"],
            $row["nome"],
            $row["cpf"],
            $row["ativo"],
            $row["dataDeNascimento"]
        ) : null;
    }

    public function create(Cliente $cliente): void {
        $sql = "INSERT INTO clientes (nome, cpf, ativo, dataDeNascimento) VALUES (:nome, :cpf, :ativo, :nascimento)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nome' => $cliente->getName(),
            ':cpf' => $cliente->getCpf(),
            ':ativo' => $cliente->getActive(),
            ':nascimento' => $cliente->getBirthDate()
        ]);
    }

    public function update(Cliente $cliente): void {
        $sql = 'UPDATE clientes SET nome = :nome, cpf = :cpf, ativo = :ativo, dataDeNascimento = :dataDeNascimento WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $cliente->getId(),
            ':nome' => $cliente->getName(),
            ':cpf' => $cliente->getCpf(),
            ':ativo' => $cliente->getActive(),
            ':dataDeNascimento' => $cliente->getBirthDate()
        ]);
    }

    public function delete(int $id): void {
    $stmt = $this->db->prepare('DELETE FROM clientes WHERE id = :id');
    $stmt->execute([':id' => $id]);
    }
}