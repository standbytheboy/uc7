<?php
require_once __DIR__ . '/../dao/ProdutoDAO.php';
require_once __DIR__ . '/../core/authservice.php';
$dao = new ProdutoDAO();
$produtos = $dao->getAll();
$user = getLoggedUser();
?>
<h1>Produtos</h1>
<?php foreach ($produtos as $p): ?>
    <p>
        <a href="ver.php?id=<?= $p->getId() ?>">
            <?= htmlspecialchars($p->getNome()) ?> - R$ <?= number_format($p->getPreco(), 2, ',', '.') ?>
        </a>
        <br>
        <small>Fornecedor: <?= $p->getFornecedor() ? $p->getFornecedor()->getNome() : 'Sem Fornecedor' ?></small>
        
        <?php if($user): ?>
            | <a href="./editar.php?id=<?= $p->getId() ?>">Editar</a>
            | <a href="./excluir.php?id=<?= $p->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir esse produto?')">Excluir</a>
        <?php endif; ?>
    </p>

<?php endforeach; ?>
<br>
<a href="../index.php">Voltar</a>