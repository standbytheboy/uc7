<?php

class Cliente {
    private ?int $id;
    private string $name;
    private string $cpf;
    private bool $active = true;
    private string $birthDate;

    public function __construct(?int $id, string $name, string $cpf, bool $active = true, string $birthDate) {
        $this->id = $id;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->active = $active;
        $this->birthDate = $birthDate;
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getCpf(): string { return $this->cpf; }
    public function getActive(): bool { return $this->active; }
    public function getBirthDate(): string { return $this->birthDate; }

    public function setName(string $name) { $this->name = $name;}
    public function setCpf(string $cpf) { $this->cpf = $cpf; }
    public function setActive(bool $active) { $this->active = $active; }
    public function setBirthDate(string $birthDate) { $this->birthDate = $birthDate; }
}