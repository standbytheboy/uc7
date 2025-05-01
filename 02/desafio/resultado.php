<?php
$salario = $_GET['salario'];

$desc = 0;

if ($salario <= 1518) {
    $desc = $salario * 0.075;
} elseif ($salario <= 2793.88) {
    $desc = $salario * 0.09;
} elseif ($salario <= 4190.83) {
    $desc = $salario * 0.12;
} elseif ($salario <= 8157.41) {
    $desc = $salario * 0.14;
} else {
    $desc = $salario * 0.14;
}

$salarioDesconto = $salario - $desc;

echo "Seu salário: $salario <br>";
echo "Seu desconto: $desc <br>";
echo "Seu salário com desconto: $salarioDesconto";