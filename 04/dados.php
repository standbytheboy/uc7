<?php

$produtos = [
    ["nome" => "Pão", "preco" => 4.50],
    ["nome" => "Café", "preco" => 9.00],
    ["nome" => "Leite", "preco" => 4.80]
];

function calcularTotalProdutos(array $itens): float
{
    $total = 0;

    foreach ($itens as $item) {
        $total += $item['preco'];
    }
    return $total;
}

echo "Total R$: " . number_format(calcularTotalProdutos($produtos), 2, ',', '.') . "<br>";

function retornarMaisBarato(array $itens): float {

    $menor = $itens[0]['preco'];

    foreach ($itens as $item) {
        if ($item['preco'] < $menor) {
            $menor = $item['preco'];
        };
    }
    return $menor;
}
echo "Menor Valor R$: " . number_format(retornarMaisBarato($produtos), 2, ',', '.') . "<br>";
