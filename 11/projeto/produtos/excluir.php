<?php
session_start();
require_once "../dao/ProdutoDAO.php";
require_once "../model/Produto.php";

$dao = new ProdutoDAO();

if (!isset($_SESSION["token"])) {
    echo "Faça login";
    exit();
}

if(isset($_GET['id'])) {
    $produto = $dao->getById((int)$_GET['id']);

    if($produto) {
        $dao->delete((int)$_GET['id']);
    }
}

header("Location: listar.php");