<?php
session_start();
require_once "../dao/ProdutoDAO.php";
require_once "../model/Produto.php";

if (!isset($_SESSION["token"])) {
    header("Location: index.php");
    exit();
}

$dao = new ProdutoDAO();
$products = $dao->getAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Lista de Produtos</h1>
    <?php if (empty($products)) {
        echo "<p>Não há produtos cadastrados.</p>";
    } ?>
    <br>
    <a href="criar.php" class="new-product">Novo Produto</a>
    <div id="mensagem"></div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Cadastro</th>
                <th>Validade</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabelaProdutos">
            <?php
            // Itera sobre cada objeto Produto no array $products
            foreach ($products as $produto) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto->getNome()); ?></td>
                    <td>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($produto->getDataDeCadastro()); ?></td>
                    <td><?php echo htmlspecialchars($produto->getDataDeValidade()); ?></td>
                    <td><?php echo $produto->getAtivo() ? 'Sim' : 'Não'; ?></td>
                    <td>
                        <!-- Links para ações de editar e excluir -->
                        <a href="criar.php?id=<?php echo htmlspecialchars($produto->getId()); ?>" class="edit-button">Editar</a>
                        <a href="excluir.php?id=<?php echo htmlspecialchars($produto->getId()); ?>" class="delete-button" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    
    <a href="../index.php">Voltar</a>


    
</body>
</html>