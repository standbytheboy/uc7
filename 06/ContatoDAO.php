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

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $contatos[] = new Contato($row['id'], $row['nome'], $row['telefone'], $row['email'], $row['endereco']);
        }

        return $contatos;
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
}
?>