<?php

class Usuario implements JsonSerializable {
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private ?string $token;

    public function __construct(?int $id, string $nome, string $email, string $senha, ?string $token = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->token = $token;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getSenha(): string { return $this->senha; }
    public function getEmail(): string { return $this->email; }
    public function getToken(): ?string { return $this->token; }

    public function setId(?int $id): void { $this->id = $id; }
    public function setNome(string $nome): void { $this->nome = $nome; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setSenha(string $senha): void { $this->senha = $senha; }
    public function setToken(?string $token): void { $this->token = $token; }

    // Para serialização JSON
    public function jsonSerialize(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "email" => $this->email,
        ];
    }
}