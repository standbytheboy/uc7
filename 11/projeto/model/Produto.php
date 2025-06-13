<?php

class Produto {
    private ?int $id;
    private string $nome;
    private string $preco;
    private string $ativo;
    private ?string $dataCadastro;
    private ?string $dataValidade;

    public function __construct(?int $id, string $nome, string $preco, string $ativo, ?string $dataCadastro, ?string $dataValidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->preco = $preco;
        $this->dataCadastro = $dataCadastro;
        $this->dataValidade = $dataValidade;
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getAtivo(): string { return $this->ativo; }
    public function getPreco(): string { return $this->preco; }
    public function getDataCadastro(): ?string { return $this->dataCadastro; }
    public function getDataValidade(): ?string { return $this->dataValidade; }
}