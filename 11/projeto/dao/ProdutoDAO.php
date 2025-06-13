<?php

require_once '../core/Database.php';
require_once '../model/Produto.php';

class ProdutoDAO {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(Produto $Produto) {
        $sql = 'INSERT INTO produto (nome, preco, ativo, dataCadastro, dataValidade) VALUES (:nome, :preco, :ativo, :dataCadastro, :dataValidade)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome' => $Produto->getNome(), 
            ':preco' => $Produto->getPreco(), 
            ':ativo' => $Produto->getAtivo(), 
            ':dataCadastro' => $Produto->getDataCadastro(), 
            ':dataValidade' => $Produto->getDataValidade(), 
        ]);
    }
}