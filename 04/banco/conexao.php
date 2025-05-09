<?php

$user = "root";
$password = "";
$database = "loja_produtos";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, "");

    $resultado = $db->query("SELECT * FROM produtos");

    $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_GET['nome']) && isset($_GET['preco'])) {
        $nome = $_GET['nome'];
        $preco = $_GET['preco'];

        $stmt = $db->prepare("INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)");

        $stmt->execute([
            ":nome"=> $nome,
            ":preco"=> $preco
        ]);
        header("Location: conexao.php");
        exit;
    }
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
</head>

<body>
    <h1>Cadastro de Produto</h1>

    <form method="get" action="conexao.php">
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