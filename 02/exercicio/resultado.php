<?php
/*
1 - Crie um formulário que receba 4 notas
2 - Receba os valores da requisição no PHP
3 - Converta os valores recebidos para float
4 - Some os 4 valores e retorne a média
5 - Escreva "Aprovado" (>=7), "Recuperação (>=5), "Reprovado"
*/

$n1 = (float) $_GET['n1'];
$n2 = (float) $_GET['n2'];
$n3 = (float) $_GET['n3'];
$n4 = (float) $_GET['n4'];

$media = ($n1 + $n2 + $n3 + $n4) / 4;
echo "Nota $media" . "<br>";

if ($media >= 7) {
    echo "Aprovado";
} elseif ($media >= 5) {
    echo "Recuperação";
} else {
    echo "Reprovado";
}