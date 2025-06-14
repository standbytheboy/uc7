<?php
session_start();
require_once '../dao/ProdutoDAO.php';
require_once '../model/Produto.php';

$dao = new ProdutoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    $ativo = filter_input(INPUT_POST, 'ativo', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    $cadastro = filter_input(INPUT_POST, 'cadastro');
    $validade = filter_input(INPUT_POST, 'validade');
    
    if (!$name || !$price || !$cadastro || !$validade || !$ativo ) {
        $error = 'Dados inválidos.';
    } else {
        $product = new Produto(null, $name, $price, $ativo, $cadastro, $validade);

        if($dao->create($product)) {
            header('Location: listar.php');
            exit();
        } 
        
        else {
            $error = 'Erro ao cadastrar o produto!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    <title>Cadastro de Produtos</title>
</head>
<body>
<h1>Cadastro</h1>

<form action="" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" required>
    
    <label for="price">Preço:</label>
    <input type="number" name="price" required>
    
    <label for="ativo">Ativo:</label>
    <input type="checkbox" value="1" name="ativo" required>
    
    <label for="cadastro">Data de Cadastro:</label>
    <input type="date" name="cadastro" required>
    
    <label for="validade">Data de Validade:</label>
    <input type="date" name="validade" required>
    
    <?php if(isset($error)) echo "<p style='color: red'>$error</p>"; ?>
    
    <button type="submit">Cadastrar</button>
</form>

<a href="listar.php">Cancelar</a>
</body>
</html>