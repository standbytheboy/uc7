<?php

class Cliente implements JsonSerializable // implements serve para mostrar os dados na tela
{
    private ?int $id;
    private string $nome;
    private string $cpf;
    private string $dataDeNascimento;
    private bool $ativo;

    public function __construct(?int $id, string $nome, string $cpf, string $dataDeNascimento, bool $ativo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dataDeNascimento = $dataDeNascimento;
        $this->ativo = $ativo;
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getCpf(): string { return $this->cpf; }
    public function getDataDeNascimento(): string { return $this->dataDeNascimento; }
    public function getAtivo(): bool { return $this->ativo; }

    public function jsonSerialize(): array { // propriedades que vão pro JSON
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf
        ]; 
    }
}