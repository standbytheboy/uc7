<?php
require_once __DIR__ . '/../core/authService.php';
requireLogin();
require_once __DIR__ . '/../dao/ProdutoDAO.php';
require_once __DIR__ . '/../dao/FornecedorDAO.php';
require_once __DIR__ . '/../model/Produto.php';

$fornecedorDAO = new FornecedorDAO();
$fornecedores = $fornecedorDAO->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = (float) ($_POST['preco'] ?? 0);
    $ativo = isset($_POST['ativo']) ? true : false;
    $validade = $_POST['dataDeValidade'] ?: null;
    $cadastro = date('Y-m-d');

    $fornedorId = $_POST['fornecedor_id'];
    $fornecedor = $fornedorId ? $fornecedorDAO->getById($fornedorId) : null;

    $produto = new Produto(null, $nome, $preco, $ativo, $cadastro, $validade, $fornecedor);
    $dao = new ProdutoDAO();
    if ($dao->create($produto)) {
        header('Location: listar.php');
        exit();
    }
    $erro = "Erro ao criar produto.";
}
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
    
<h1>Criar Produto</h1>
<?php if (isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>
<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Preço: <input type="number" name="preco" step="0.01" required><br>

    Fornecedor:
    <select name="fornecedor_id">
        <option value="">-- Sem Fornecedor --</option>
        <?php foreach($fornecedores as $fornecedor): ?>
            <option value="<?= $fornecedor->getId() ?>">
                <?= $fornecedor->getNome() ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Ativo: <input type="checkbox" name="ativo" checked><br>
    Validade: <input type="date" name="dataDeValidade"><br>
    <button type="submit">Salvar</button>
</form>

</body>
</html>