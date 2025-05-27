<?php
require_once '../backend/ProdutoDAO.php';
$dao = new ProdutoDAO();

if(isset($_GET['id'])) {
    $produto = $dao->getById((int)$_GET['id']);

    if($produto) {
        $dao->delete((int)$_GET['id']);
    }
}

header("Location: ../index.php");