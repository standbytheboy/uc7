<?php
require_once __DIR__ . '/../dao/ProdutoDAO.php';
require_once __DIR__ . '/../core/authService.php';
$dao = new ProdutoDAO();
$produtos = $dao->getAll();

$user = getLoggedUser();
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
    <h1>Produtos</h1>

    <?php if($user): ?>
        <h4><a href="./criar.php">Cadastrar</a></h4>
    <?php endif; ?>

    <?php foreach ($produtos as $p): ?>
        <p>
            <a href="ver.php?id=<?= $p->getId() ?>">
                <?= htmlspecialchars($p->getNome()) ?> - R$ <?= number_format($p->getPreco(), 2, ',', '.') ?>
            </a>
            <br>
            <small>Fornecedor: <?= $p->getFornecedor() ? $p->getFornecedor()->getNome() : 'Não tem' ?></small>

            <?php if($user): ?>
                | <a href="./editar.php?id=<?= $p->getId() ?>">Editar</a>
                | <a href="./excluir.php?id=<?= $p->getId() ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            <?php endif; ?>
        </p>

    <?php endforeach; ?>
    <br>
    <a href="../index.php">Voltar</a>
</body>
</html>