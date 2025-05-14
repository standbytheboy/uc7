<?php

class Pizza
{
    private int $id;
    private string $sabor;
    private string $tamanho;
    private float $preco;

    public function __construct($id, string $sabor, string $tamanho, float $preco)
    {
        $this->id = $id;
        $this->sabor = $sabor;
        $this->tamanho = $tamanho;
        $this->preco = $preco;
    }
    public function getId(): int { return $this->id; }
    public function getSabor(): string { return $this->sabor; }
    public function getTamanho(): string { return $this->tamanho; }
    public function getPreco(): float { return $this->preco; }
    public function setPreco(float $preco): void
    {
        if ($preco > 0) {
            $this->preco = $preco;
        }
    }

    public function __toString(){
        return "Pizza de $this->sabor e Preço R$: $this->preco";
    }
}