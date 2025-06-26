<?php

class Fornecedor {
    private ?int $id;
    private string $nome;
    private ?string $cnpj;
    private ?string $contato;

    public function __construct($id, $nome, $cnpj, $contato){
    $this->id = $id;
    $this->nome = $nome;
    $this->cnpj = $cnpj;
    $this->contato = $contato;
    }

    public function getId() : ?int {return $this->id; }
    public function getNome() : string {return $this->nome; }
    public function getCnpj() : ?string {return $this->cnpj; }
    public function getContato() : ?string {return $this->contato; }

}