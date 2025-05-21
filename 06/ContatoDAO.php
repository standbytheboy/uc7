<?php

require_once 'Database.php';
require_once 'Contato.php';

class ContatoDAO
{
    private $db; // usado em todas as funções

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM contatos");
        $contatos = []; // inicializa um array vazio    

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contatos[] = new Contato($row['id'], $row['nome'], $row['telefone'], $row['email'], $row['endereco']);
        }

        return $contatos;
    }

    public function getById(int $id): ?Contato
    {
        $stmt = $this->db->prepare("SELECT * FROM agenda.contatos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); // só uma linha pq a pesquisa só retorna uma linha do db
        return $row ? new Contato(
            $row['id'],
            $row['nome'],
            $row['telefone'],
            $row['email'],
            $row['endereco']
        )
            : null;
    }
    public function create(Contato $contato)
    {
        $sql = "INSERT INTO contatos (nome, telefone, email, endereco) VALUES (:nome, :telefone, :email, :endereco)";
        $stmt = $this->db->prepare($sql);

        $nome = $contato->getName();
        $telefone = $contato->getTelefone();
        $email = $contato->getEmail();
        $endereco = $contato->getEndereco();

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->execute();
    }

    public function update(Contato $contato) {
        $sql = "UPDATE contatos SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco where id = :id";
        
        $id = $contato->getId();
        $nome = $contato->getName();
        $telefone = $contato->getTelefone();
        $email = $contato->getEmail();
        $endereco = $contato->getEndereco();
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("nome", $nome);
        $stmt->bindParam("telefone", $telefone);
        $stmt->bindParam("email", $email);
        $stmt->bindParam("endereco", $endereco);
        $stmt->execute();
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare('DELETE FROM contatos WHERE id = :id');
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}
?>