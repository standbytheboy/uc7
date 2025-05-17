<?php

require_once 'ContatoDAO.php';
$dao = new ContatoDAO();
$contatos = $dao->getAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/akar-icons-fonts"></script>
    <title>Lista de Contatos</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            text-align: left;
            padding: 12px 16px;
        }

        th {
            background-color: #f0f2f5;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        tr:hover {
            background-color: #f1f9ff;
        }

        a {
            text-decoration: none;
            margin-right: 10px;
            color: #0077cc;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #004999;
        }

        svg {
            vertical-align: middle;
        }

        /* Botão de adicionar novo contato */
        a[href$="contato_form.php"] {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0077cc;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a[href$="contato_form.php"]:hover {
            background-color: #005fa3;
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid #ddd;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                font-weight: bold;
                color: #666;
            }

            tr {
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 6px;
                padding: 10px;
                background: #fff;
            }
        }
    </style>
</head>
<body>
    <h2>Lista de Contatos</h2>

    <table border="1" cellpadding="5">
        <tr>
            <!-- <th>ID</th> -->
            <th>Nome</th>
            <th>Telefone</th>
            <!-- <th>Email</th>
            <th>Endereco</th> -->
            <th>Ações</th>
        </tr>
        <?php foreach ($contatos as $c): ?>
            <tr>
                <!-- <td><?= $c->getId() ?></td> -->
                <td><?= $c->getName() ?></td>
                <td><?= $c->getTelefone() ?></td>
                <!-- <td><?= $c->getEmail() ?></td>
                <td><?= $c->getEndereco() ?></td> -->
                <td>
                    <a href="./contato_details.php?id=<?= $c->getId() ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke-width="2" class="ai ai-MoreHorizontalFill"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M18 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/></svg></a>
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ai ai-Edit"><path d="M16.474 5.408l2.118 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621z"/><path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3"/></svg></a>
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ai ai-TrashCan"><path d="M4 6h16l-1.58 14.22A2 2 0 0 1 16.432 22H7.568a2 2 0 0 1-1.988-1.78L4 6z"/><path d="M7.345 3.147A2 2 0 0 1 9.154 2h5.692a2 2 0 0 1 1.81 1.147L18 6H6l1.345-2.853z"/><path d="M2 6h20"/><path d="M10 11v5"/><path d="M14 11v5"/></svg></a>                
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="./contato_form.php">Cadastrar Contato</a>
</body>
</html>