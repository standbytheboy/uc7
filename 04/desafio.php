<form action="./desafio.php" method="get">
    <label for="produto">Digite o nome do produto:</label>
    <input type="text" name="produto" required>
    <label for="preco">Digite o preço:</label>
    <input type="number" name="preco" required>
    <button type="submit">Ver Produtos</button>
</form>

<ul>

    <?php
    $produto = $_GET['produto'];
    $preco = $_GET['preco'];
    $produtos = [];

    function inserirProdutos($pdt, $prc): array
    {
        $produtos = [
            $pdt,
            $prc
        ];

        foreach ($produtos as $p) {
            echo'<li>' . $p . '</li>';
        }
        return $produtos;
    }

    inserirProdutos($produto, $preco);

    ?>

</ul>