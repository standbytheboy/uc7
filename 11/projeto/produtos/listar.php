<?php
session_start();
require_once "../dao/ProdutoDAO.php";
require_once "../model/Produto.php";

if (!isset($_SESSION["token"])) {
    header("Location: index.php");
    exit();
}

$dao = new ProdutoDAO();
$products = $dao->getAll(); // Renomeado para $products para melhor clareza no plural
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .button, .edit-button, .delete-button {
            display: inline-block;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .button {
            background-color: #28a745;
            color: white;
        }
        .button:hover {
            background-color: #218838;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        thead th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tbody tr:hover {
            background-color: #e2e6ea;
        }
        .edit-button {
            background-color: #007bff;
            color: white;
            margin-right: 5px;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        #mensagem {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #ffe0b2; /* Light orange for messages */
            color: #e65100; /* Darker orange text */
            border: 1px solid #ffcc80;
            text-align: center;
            display: none; /* Escondido por padrão, pode ser mostrado via JS */
        }
        /* Responsividade básica */
        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 0.9em;
            }
            th, td {
                padding: 8px 10px;
            }
        }
        @media (max-width: 480px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
            }
            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }
            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
            td:nth-of-type(1):before { content: "Nome"; }
            td:nth-of-type(2):before { content: "Preço"; }
            td:nth-of-type(3):before { content: "Cadastro"; }
            td:nth-of-type(4):before { content: "Validade"; }
            td:nth-of-type(5):before { content: "Ativo"; }
            td:nth-of-type(6):before { content: "Ações"; }
            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <?php if (empty($products)) {
        echo "<p>Não há produtos cadastrados.</p>";
    } ?>
    <br>
    <a href="criar.php" class="button">Novo Produto</a>
    <div id="mensagem"></div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Cadastro</th>
                <th>Validade</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabelaProdutos">
            <?php
            // Itera sobre cada objeto Produto no array $products
            foreach ($products as $produto) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto->getNome()); ?></td>
                    <td>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($produto->getDataDeCadastro()); ?></td>
                    <td><?php echo htmlspecialchars($produto->getDataDeValidade()); ?></td>
                    <td><?php echo $produto->getAtivo() ? 'Sim' : 'Não'; ?></td>
                    <td>
                        <!-- Links para ações de editar e excluir -->
                        <a href="produto-form.html?id=<?php echo htmlspecialchars($produto->getId()); ?>" class="edit-button">Editar</a>
                        <a href="excluir.php?id=<?php echo htmlspecialchars($produto->getId()); ?>" class="delete-button" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    
    <a href="../index.php">Voltar</a>


    
</body>
</html>