<?php

class Produto
{
    private ?int $id;
    private string $nome;
    private float $preco;
    private bool $ativo;
    private string $dataDeCadastro;
    private ?string $dataDeValidade;

    public function __construct(?int $id, string $nome, float $preco, bool $ativo, string $dataDeCadastro, ?string $dataDeValidade)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->ativo = $ativo;
        $this->dataDeCadastro = $dataDeCadastro;
        $this->dataDeValidade = $dataDeValidade;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getPreco(): float { return $this->preco; }
    public function getAtivo(): bool { return $this->ativo; }
    public function getDataDeCadastro(): string { return $this->dataDeCadastro; }
    public function getDataDeValidade(): ?string { return $this->dataDeValidade; }

    // Setters
    public function setNome(string $nome) { $this->nome = $nome; }
    public function setPreco(float $preco) { $this->preco = $preco; }
    public function setAtivo(bool $ativo) { $this->ativo = $ativo; }
    public function setDataDeCadastro(string $cadastro) { $this->dataDeCadastro = $cadastro; }
    public function setDataDeValidade(?string $validade) { $this->dataDeValidade = $validade; }
}