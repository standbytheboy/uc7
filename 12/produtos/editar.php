<?php
require_once __DIR__ . '/../core/authService.php';
requireLogin();
require_once __DIR__ . '/../dao/ProdutoDAO.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$dao = new ProdutoDAO();
$produto = $dao->getById($id);
if (!$produto) exit("Produto não encontrado");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto = new Produto(
        $id,
        $_POST['nome'],
        (float) $_POST['preco'],
        isset($_POST['ativo']),
        $produto->getDataDeCadastro(),
        $_POST['dataDeValidade'] ?: null
    );
    if ($dao->update($produto)) {
        header('Location: listar.php');
        exit();
    }
    $erro = "Erro ao atualizar.";
}
?>
<h1>Editar Produto</h1>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $produto->getNome() ?>"><br>
    Preço: <input type="number" name="preco" step="0.01" value="<?= $produto->getPreco() ?>"><br>
    Ativo: <input type="checkbox" name="ativo" <?= $produto->getAtivo() ? 'checked' : '' ?>><br>
    Validade: <input type="date" name="dataDeValidade" value="<?= $produto->getDataDeValidade() ?>"><br>
    <button type="submit">Atualizar</button>
</form>
