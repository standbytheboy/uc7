<?php

class Contato
{
    private ?int $id;
    private string $name;
    private string $telefone;
    private string $email;
    private ?string $endereco;

    public function __construct(?int $id, string $name, string $telefone, string $email, ?string $endereco = null)
    { $this->id = $id; $this->name = $name; $this->telefone = $telefone; $this->email = $email; $this->endereco = $endereco; }

    public function getId(): ?int {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getTelefone(): string {
        return $this->telefone;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getEndereco(): ?string {
        return $this->endereco;
    }
    public function setName(string $name) {
        $this->name = $name;
    }
    public function setEndereco(string $endereco) {
        $this->endereco = $endereco;
    }
}