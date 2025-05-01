<?php

$a = 10;
$b = 15;

echo "Soma: " . ($a + $b) . "<br>";
echo "$a é maior que $b? " . ($a > $b ? "Sim" : "Não") . "<br>";

$idade = 57;

if($idade >= 18) {
    echo "Maior de idade, $idade anos!<br>";
} else {
    echo "Menor de idade, $idade anos!<br>";
}

// SWITCH CASE
$dia = "sexta";

switch($dia) {
    case "segunda":
        echo "Início da semana";
        break;
    case "sexta":
        echo "Último dia útil";
        break;
    default:
        echo "Dia comum";
}