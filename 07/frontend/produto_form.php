<?php

require_once '../backend/ProdutoDAO.php';
$dao = new ProdutoDAO();
$produto = null;

if (isset($_GET['id'])) {
    $produto = $dao->getById($_GET['id']);
}

if ($_POST) {

    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $ativo = $_POST['ativo'] ? true : false;
    $dataDeCadastro = $_POST['dataDeCadastro'];
    $dataDeValidade = $_POST['dataDeValidade'] ?: null; // ?:

    $produto = new Produto($id, $nome, $preco, $ativo, $dataDeCadastro, $dataDeValidade);

    if ($id) {
        $dao->update($produto);
    } else {
        $dao->create($produto);
    }

    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Formulario de Produto</title> -->
    <title><?= $produto ? 'Edição de Produto' : 'Cadastro de Produto' ?></title>
</head>

<body>
    <h2><?= $produto ? 'Editar Produto' : 'Cadastrar Produto' ?></h2>

    <form action="produto_form.php" method="post">
        <?php if ($produto): ?>
            <input hidden name="id" required value="<?= $produto->getId() ?>">
        <?php endif; ?>

        <label>Nome:</label>
        <input type="text" name="nome" required value="<?= $produto ? $produto->getNome() : '' ?>"><br>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" required value="<?= $produto ? $produto->getPreco() : '' ?>"><br>

        <label>Ativo:</label>
        <input type="checkbox" name="ativo" value="1" <?= $produto && $produto->getAtivo() ? 'checked' : '' ?>><br>

        <label>Data de Cadastro:</label>
        <input type="date" name="dataDeCadastro" required value="<?= $produto ? $produto->getDataDeCadastro() : '' ?>"><br>

        <label>Data de Validade:</label>
        <input type="date" name="dataDeValidade" value="<?= $produto ? $produto->getDataDeValidade() : '' ?>"><br>

        <button type="submit">Salvar</button>
    </form>

    <a href="../index.php">Cancelar</a>
</body>

</html>