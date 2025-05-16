<?php
require_once 'ContatoDAO.php';
$dao = new ContatoDAO();
$contatos = $dao->getAll();

if (isset($_POST['name']) && ($_POST['phone']) && ($_POST['mail'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];

    $address = null;
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    }
    $contato = new Contato(null, $name, $phone, $mail, $address);
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

        input[type="text"] {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
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
    <h2>Cadastrar Contato</h2>
    <form action="./contato_form.php" method="post">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" required placeholder="Digite seu nome...">

        <label for="phone">Telefone</label>
        <input type="text" name="phone" id="phone" required placeholder="Digite seu telefone...">

        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail" required placeholder="Digite seu email...">

        <label for="adress">Endereço</label>
        <input type="text" name="adress" id="adress" placeholder="Digite seu endereço (opcional)">
        <button type="submit">Salvar</button>
    </form>
</body>

</html>