<?php
session_start();

$isLogged = isset($_SESSION['token']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        h1 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 30px;
        }

        p {
            text-align: center;
            font-size: 1.1em;
            margin-top: 20px;
        }

        /* --- Navigation Bar --- */
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #575757;
        }

        nav a:active {
            background-color: #0056b3;
        }
    </style>
    <title>Document</title>
</head>
<body>
    
    <h1>Home</h1>

    <p>Bem-vindo ao sistema!</p>
    <nav>
    <a href="index.php">Home</a>
        <?php if ($isLogged): ?>
            <a href="index.php">Minha Conta</a>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastrar</a>
        <?php endif; ?>
    </nav>

</body>
</html>