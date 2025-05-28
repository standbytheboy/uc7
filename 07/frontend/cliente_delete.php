<?php
require_once '../backend/ClienteDAO.php';
$dao = new ClienteDAO();

if(isset($_GET['id'])) {
    $cliente = $dao->getById((int)$_GET['id']);

    if($cliente) {
        $dao->delete((int)$_GET['id']);
    }
}

header("Location: ../index.php");