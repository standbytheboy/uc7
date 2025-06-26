<?php
require_once __DIR__ . '/../core/authService.php';
requireLogin();
require_once __DIR__ . '/../dao/ProdutoDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = (float) ($_POST['preco'] ?? 0);
    $ativo = isset($_POST['ativo']) ? true : false;
    $validade = $_POST['dataDeValidade'] ?: null;
    $cadastro = date('Y-m-d');

    $produto = new Produto(null, $nome, $preco, $ativo, $cadastro, $validade);
    $dao = new ProdutoDAO();
    if ($dao->create($produto)) {
        header('Location: listar.php');
        exit();
    }
    $erro = "Erro ao criar produto.";
}
?>
<h1>Criar Produto</h1>
<?php if (isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>
<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Preço: <input type="number" name="preco" step="0.01" required><br>
    Ativo: <input type="checkbox" name="ativo" checked><br>
    Validade: <input type="date" name="dataDeValidade"><br>
    <button type="submit">Salvar</button>
</form>
