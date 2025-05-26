<?php
require_once './backend/ProdutoDAO.php';

$dao = New ProdutoDAO();
$produtos = $dao->getAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Produtos</title>
</head>
<body>
    <h2>Lista de Produtos</h2>

    <a href="./frontend/produto_form.php">Cadastrar Novo Produto</a>

    <table border="1" cellpading="4">
        <tr>
            <td>Nome</td>
            <td>Preço</td>
            <td>Ações</td>
        </tr>
        <?php foreach($produtos as $prd): ?>
        <tr>
            <td><?= $prd->getNome() ?></td>
            <td><?= $prd->getPreco() ?></td>
            <td>
                <a href="./frontend/produto_details.php?id=<?= $prd->getId() ?>">Detalhes</a>
                <a href="./frontend/produto_form.php?id=<?= $prd->getId() ?>">Editar</a>
                <a href="./frontend/produto_delete.php?id=<?= $prd->getId() ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>