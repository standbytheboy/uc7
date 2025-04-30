<?php
$produto = $_GET['produto'];
$preco = $_GET['preco'];
$quantidade = $_GET['quantidade'];

$total = $preco * $quantidade;

echo "Total: R$ " . $total;