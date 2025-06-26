<?php

class Usuario implements JsonSerializable
{
    private ?int $id;
    private string $nome;
    private string $senha;
    private string $email;
    private ?string $token;

    public function __construct(?int $id, string $nome, string $senha, string $email, ?string $token = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->token = $token;
    }

    public function getId(): ?int { return $this->id; }
    public function getnome(): string { return $this->nome; }
    public function getSenha(): string { return $this->senha; }
    public function getEmail(): string { return $this->email; }
    public function getToken(): ?string { return $this->token; }

    public function setToken(?string $token): void { $this->token = $token; }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'token' => $this->token
        ];
    }
}
