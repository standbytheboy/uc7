<?php

require_once 'PizzaDAO.php';
require_once 'Pizza.php';
$dao = new PizzaDAO();
$pizzaEdit = null; //variável para tela de edição

// editar pizza
if (isset($_GET['id'])) {
    $pizzaEdit = $dao->getById($_GET['id']);
}

// salvar edição
if (isset($_POST['id'])) {
    $pizzaEdit = new Pizza($_POST['id'], $_POST['sabor'], $_POST['tamanho'], $_POST['preco']);
    $dao->update($pizzaEdit);

    header('Location: index.php');
    exit;
}

// criar nova pizza
if (isset($_POST['sabor']) && isset($_POST['tamanho']) && isset($_POST['preco'])) {
    $sabor = $_POST['sabor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];

    $pizza = new Pizza(null, $sabor, $tamanho, $preco);
    $dao->create($pizza);

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Pizza</title>
</head>

<body>
    <h2><?= $pizzaEdit ? "Editar Pizza" : "Cadastrar Nova Pizza" ?></h2>

    <form action="pizza_form.php" method="post">
        <?php if ($pizzaEdit): ?>
            <input type="hidden" name="id" value="<?= $pizzaEdit->getId() ?>">
        <?php endif; ?>
        <label>Sabor:</label>
        <input type="text" name="sabor" required value="<?= $pizzaEdit ? $pizzaEdit->getSabor() : null ?>">

        <label>Tamanho:</label>
        <input type="text" name="tamanho" required value="<?= $pizzaEdit ? $pizzaEdit->getTamanho() : null ?>">

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" required value="<?= $pizzaEdit ? $pizzaEdit->getPreco() : null ?>">


        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="index.php">Cancelar</a>
</body>

</html>