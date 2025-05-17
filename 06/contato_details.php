<?php
require_once 'ContatoDAO.php';

if (!isset($_GET['id'])) {
    echo 'ID do contato não fornecido!';
    exit;
};

$dao = new ContatoDAO();
$contato = $dao->getById($_GET['id']);

if (!$contato) {
    echo 'Contato não encontrado no sistema!';
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Contato</title>
</head>
<body>
    <h2>Detalhes do Contato</h2>

    <p><strong>ID:</strong> <?= $contato->getId() ?></p>
    <p><strong>Nome:</strong> <?= $contato->getName() ?></p>
    <p><strong>Telefone:</strong> <?= $contato->getTelefone() ?></p>
    <p><strong>Email:</strong> <?= $contato->getEmail() ?></p>
    <p><strong>Endereço:</strong> <?= $contato->getEndereco() ?? "N/A" ?></p>

    <br>
    <a href="./index.php">Voltar</a>
</body>
</html>