<ul>

    <?php
    $frutas = ["Goiaba", "Uva", "Laranja"]; //trouxe do banco de dados
    foreach ($frutas as $fruta) {
        echo "<li> $fruta </li>";
    }
    ?>

</ul>

<!-- Array Associativo  -->

<table border="1">

    <?php
    $cliente = [
        "Nome" => "Carlos",
        "Idade" => 33,
        "Email" => "carlos@mail.com"
    ];

    foreach ($cliente as $key => $value) {
        echo "<tr><td><strong>$key</strong></td><td>$value</td></tr>";
    }
    ?>

</table>

<!-- Array Multidimensional (Matriz) -->

<table border="1">
    <br>
    <tr>
        <th>Produto</th>
        <th>Preço</th>
    </tr>
    <?php
    $produtos = [
        ["nome" => "Pão", "preco" => 1.50],
        ["nome" => "Café", "preco" => 3.00],
        ["nome" => "Leite", "preco" => 4.80]
    ];

    foreach ($produtos as $produto) {
        echo "
        <tr>
            <td>{$produto['nome']}</td> " .
            "<td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>
        </tr>
    ";
    }
    ?>

</table>