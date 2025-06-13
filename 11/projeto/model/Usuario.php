<?php

class Usuario {
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private ? string $token;

    public function __construct(?int $id, string $nome, string $email, string $senha, ? string $token = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->token = $token;
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getSenha(): string { return $this->senha; }
    public function getEmail(): string { return $this->email; }
    public function getToken(): ?string { return $this->token; }
}