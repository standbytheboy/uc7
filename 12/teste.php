<?php

class Cidade {
    private $id;
    private $nome;
    public Estado $estado;

    public function __construct($id, $nome, $estado) {
        $this->id = $id;
        $this->nome = $nome;
        $this->estado = $estado;
    }
}

class Estado {
    private $id;
    private $uf;

    public function __construct($id, $uf) {
        $this->id = $id;
        $this->uf = $uf;
    }
}

$bahia = new Estado(15, "BA");
$minasGerais = new Estado(18, "MG");
$salvador = new Cidade(12, "Salvador", $bahia);
