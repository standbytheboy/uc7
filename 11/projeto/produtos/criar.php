<?php
session_start();
require_once '../dao/ProdutoDAO.php';
require_once '../model/Produto.php';

$dao = new ProdutoDAO();
$product = null;

if (isset($_GET['id'])) {
    $product = $dao->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    $ativo = filter_input(INPUT_POST, 'ativo', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    $cadastro = filter_input(INPUT_POST, 'cadastro');
    $validade = filter_input(INPUT_POST, 'validade');
    
    if (!$name || $price === false || !$cadastro || !$validade || !$ativo ) {
        $error = 'Dados inválidos.';
    } else {
        $product = new Produto($id, $name, $price, $ativo, $cadastro, $validade);

        $operation_success = false;
            if ($id) { // Se o ID existe, é uma atualização
                $operation_success = $dao->update($product);
            } else { // Se o ID não existe, é um novo produto
                $operation_success = $dao->create($product);
            }

            if ($operation_success) {
                // Redireciona para a página de listagem com uma mensagem de sucesso
                header('Location: listar.php?status=success&message=' . ($id ? 'Produto atualizado com sucesso!' : 'Produto cadastrado com sucesso!'));
                exit();
            } else {
                $error = 'Erro ao processar o produto no banco de dados. Tente novamente.';
            }
    }

    $error = 'Erro ao cadastrar o produto!';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/create.css">
    <title><?= $product ? 'Edição de Produto' : 'Cadastro de Produto' ?></title>
</head>

<body>
    <h2><?= $product ? 'Editar Produto' : 'Cadastrar Produto' ?></h2>
    <form action="" method="post">
        <?php if ($product): ?>
            <input hidden name="id" required value="<?= $product->getId() ?>">
        <?php endif; ?>

        <label>Nome:</label>
        <input type="text" name="name" required value="<?= $product ? $product->getNome() : '' ?>"><br>

        <label>Preço:</label>
        <input type="number" name="price" step="0.01" required value="<?= $product ? $product->getPreco() : '' ?>"><br>

        <label>Ativo:</label>
        <input type="checkbox" name="ativo" value="1" <?= $product && $product->getAtivo() ? 'checked' : '' ?>><br>

        <label>Data de Cadastro:</label>
        <input type="date" name="cadastro" required value="<?= $product ? $product->getDataDeCadastro() : '' ?>"><br>

        <label>Data de Validade:</label>
        <input type="date" name="validade" value="<?= $product ? $product->getDataDeValidade() : '' ?>"><br>

        <?php if (!empty($error)): ?>
            <p style='color: red'><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <button type="submit">Salvar</button>
    </form>

    <a href="listar.php">Cancelar</a>
</body>
</html>