<?php
require_once 'ContatoDAO.php';
$dao = new ContatoDAO();
$contato = null; // Contato para a edição

// Editar Contato
if(isset($_GET['id'])) {
    $contato = $dao->getById($_GET['id']);
}

// Salvar Edição de Contato
if(isset($_POST['id'])) {
    $endereco = null;
    if(isset($_POST['endereco']))
    {
        $endereco = $_POST['endereco'];
    }

    $contato = new Contato($_POST['id'], $_POST['nome'], $_POST['telefone'], $_POST['email'], $endereco);
    $dao->update($contato);

    header("Location: index.php");
    exit;
}

// Criar novo Contato
if(isset($_POST['nome']) && isset($_POST['telefone']) && isset($_POST['email']))
{
    $endereco = null;
    if(isset($_POST['endereco']))
    {
        $endereco = $_POST['endereco'];
    }

    $contato = new Contato(null, $_POST['nome'], $_POST['telefone'], $_POST['email'], $endereco);
    $dao->create($contato);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Contato</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #222;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"] {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #0077cc;
            outline: none;
        }

        button[type="submit"] {
            background-color: #0077cc;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #005fa3;
        }

        @media (max-width: 500px) {
            body {
                padding: 20px;
            }

            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <h2><?= $contato? "Editar Contato" : "Cadastrar Novo Contato" ?></h2>

    <form action="contato_form.php" method="post">
        <?php if ($contato): ?>
            <input type="hidden" name="id" value="<?= $contato->getId() ?>">
        <?php endif; ?>

        <label>Nome:</label>
        <input type="text" name="nome" required value="<?= $contato? $contato->getName() : ''?>"><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" required value="<?= $contato? $contato->getTelefone() : ''?>"><br>

        <label>Email:</label>
        <input type="text" name="email" required value="<?= $contato? $contato->getEmail() : ''?>"><br>

        <label>Endereço:</label>
        <input type="text" name="endereco" value="<?= $contato? $contato->getEndereco() : ''?>"><br>

        <button type="submit">Salvar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>