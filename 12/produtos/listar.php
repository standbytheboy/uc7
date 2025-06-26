<?php
require_once __DIR__ . '/../dao/ProdutoDAO.php';
$dao = new ProdutoDAO();
$produtos = $dao->getAll();
?>
<h1>Produtos</h1>
<?php foreach ($produtos as $p): ?>
    <p>
        <a href="ver.php?id=<?= $p->getId() ?>">
            <?= htmlspecialchars($p->getNome()) ?> - R$ <?= number_format($p->getPreco(), 2, ',', '.') ?>
        </a>
    </p>

<?php endforeach; ?>
<br>
<a href="../index.php">Voltar</a>