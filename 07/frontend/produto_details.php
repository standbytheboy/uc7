<?php
require_once '../backend/ProdutoDAO.php';
$dao = new ProdutoDAO();

if(!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$produto = $dao->getById($_GET['id']);

if(!$produto) {
    echo "Produto não encontrado.";
    echo "<a href='../index.php'>Voltar</a>";
    exit;
}
?>
<link rel="stylesheet" href="./details.css">
<h2>Detalhes do Produto</h2>
<ul>
    <li><strong>ID: </strong><?= $produto->getId() ?></li>
    <li><strong>Nome: </strong><?= $produto->getNome() ?></li>
    <li><strong>Preço: </strong><?= $produto->getPreco() ?></li>
    <li><strong>Ativo: </strong><?= $produto->getAtivo()? 'Sim' : 'Não' ?></li>
    <li><strong>Data de Cadastro: </strong><?= $produto->getDataDeCadastro() ?></li>
    <li><strong>Data de Validade: </strong><?= $produto->getDataDeValidade() ?></li>
</ul>