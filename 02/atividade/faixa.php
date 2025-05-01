<?php
$age = (int) $_GET["age"];

if ($age < 12) {
    echo "Criança";
} elseif ($age < 18) {
    echo "Adolescente";
} elseif ($age < 60) {
    echo "Adulto";
} else {
    echo "Idoso";
}