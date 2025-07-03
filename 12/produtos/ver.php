<?php
require_once __DIR__ . '/../dao/ProdutoDAO.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$dao = new ProdutoDAO();
$produto = $dao->getById($id);

if (!$produto) {
    echo "Produto não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <h1><?= htmlspecialchars($produto->getNome()) ?></h1>
    <p>Preço: R$ <?= number_format($produto->getPreco(), 2, ',', '.') ?></p>
    <p>Ativo: <?= $produto->getAtivo() ? 'Sim' : 'Não' ?></p>
    <p>Validade: <?= $produto->getDataDeValidade() ?: 'Sem validade' ?></p>
    <p>Fornecedor: <?= $produto->getFornecedor() ? $produto->getFornecedor()->getNome() : 'Sem Fornecedor' ?></p>
    
</body>
</html>
