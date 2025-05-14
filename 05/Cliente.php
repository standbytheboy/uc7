<?php

/*
- Cliente
Propriedades: nome, veiculo, telefone (todos private string)
Construtor que recebe todas as propreidades
Sobrescreva __toString() para visualizarmos os dados
Crie um get para o "nome" e um set para o "telefone"
*/

class Cliente {
    private string $nome;
    private string $veiculo;
    private string $telefone;

    public function __construct($nome, $veiculo, $telefone) {
        $this->nome = $nome;
        $this->veiculo = $veiculo;
        $this->telefone = $telefone;
    }
    
    public function getNome() : string {
        return $this->nome;
    }
    
    public function setTelefone(string $telefone){
        $this->telefone = $telefone;
    }

    public function __toString()
    {
        return "Nome: $this->nome, Veículo: $this->veiculo, Telefone: $this->telefone <br>";
    }
}