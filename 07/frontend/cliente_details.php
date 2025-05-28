<?php
require_once "../backend/ClienteDAO.php";
$dao = new ClienteDAO();

if(!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$cliente = $dao->getById($_GET["id"]);
if(!$cliente) {
    echo "Cliente não encontrado!";
    echo "<a href='../index.php'>Voltar</a>";
    exit;
}

?>

<link rel="stylesheet" href="./details.css">
<h2>Detalhes do Cliente</h2>
<ul>
    <li><strong>ID: </strong><?= $cliente->getId() ?></li>
    <li><strong>Nome: </strong><?= $cliente->getName() ?></li>
    <li><strong>Ativo: </strong><?= $cliente->getActive()? 'Sim' : 'Não' ?></li>
    <li><strong>Data de Nascimento: </strong><?= $cliente->getBirthDate() ?></li>
</ul>
