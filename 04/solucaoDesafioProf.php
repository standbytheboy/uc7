<!--
PHP + HTML

Crie um formulário que permita cadastrar produtos (nome e preço)
Use funções para:
- Inserir os produtos no array
-->
<?php
session_start();

if(!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

if (isset($_GET['nome']) && isset($_GET['preco'])) {
    $nome = $_GET['nome'];
    $preco = (float) $_GET['preco'];    

    $_SESSION['produtos'][] = ["nome" => $nome, "preco" => $preco];
}

$produtos = $_SESSION['produtos'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
</head>

<body>
    <h1>Cadastro de Produto</h1>

    <form method="get" action="solucaoDesafioProf.php">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" id="preco" name="preco" required>

        <button type="submit">Adicionar</button>
    </form>


    <h2>Produtos:</h2>
    <ul>
        <?php foreach ($produtos as $produto): ?>
            <li><?= $produto['nome'] ?> - R$ <?= $produto['preco'] ?></li>
        <?php endforeach; ?>
    </ul>

</body>

</html>