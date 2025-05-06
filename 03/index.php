<?php

for ($i = 0; $i < 5; $i++) {
    echo "digitando... $i <br>";
}

$contador = 1;
while ($contador < 5) {
    echo "contando: $contador <br>";
    $contador++;
}

$nomes = ["Adenilsa", "Carlos", "Gustavo", "Gabriel"];

// for($i = 0; $i < count($nomes); $i++) {
//     echo "Olá,  $nomes[$i]!  <br>";
// }

foreach ($nomes as $nom) {
    echo "Olá,  $nom!  <br>";
}