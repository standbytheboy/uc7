<table border="1">
<?php

$clientes = [
    ["nome" => "Lucas", "CPF"=> "453532439-27","cidade"=> "SP"],
    ["nome" => "Brigael", "CPF"=> "453532439-27","cidade"=> "RJ"],
];

echo "<th>Nome</th> <th>CPF</th> <th>Cidade</th>";
foreach ($clientes as $cli) {
    echo "<tr>
            <td>{$cli['nome']}</td>
            <td>{$cli['CPF']}</td>
            <td>{$cli['cidade']}</td>
        </tr>"; 
}
?>

</table>