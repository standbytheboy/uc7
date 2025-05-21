<?php

require_once 'PizzaDAO.php';

if(!isset($_GET['id']))
{
    echo "ID da pizza não fornecido!";
    exit();
}

$dao = new PizzaDAO();
$pizza = $dao->getById($_GET['id']);

if(!$pizza)
{
    echo "Pizza não encontrada no Sistema!";
    exit();
}

$dao->delete($pizza->getId());
header("Location: index.php");
?>