<?php

require 'PizzaDAO.php';
$dao = new PizzaDAO();
$pizzas = $dao->getAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Pizzas</title>    
</head>
<body>
    <h2>Cadastro de Pizzas</h2>

    <table>
        <tr><th>SABOR</th><th>TAMANHO</th><th>PREÇO</th><th>EDITAR PIZZA</th><th>EXCLUIR</th></tr>
        <?php foreach($pizzas as $p): ?>
            <tr>
                <!-- <td><?= $p->getId() ?></td> -->
                <td><?= $p->getSabor() ?></td>
                <td><?= $p->getTamanho() ?></td>
                <td><?= $p->getPreco() ?></td>
                <td><a href="./pizza_form.php?id=<?= $p->getId() ?>">Editar Pizza</a></td>
                <td><a href="./pizza_delete.php?id=<?= $p->getId() ?>">Excluir Pizza</a></td>
                
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="./pizza_form.php">Nova Pizza</a><br>
</body>
</html>