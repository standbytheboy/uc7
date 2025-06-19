<?php
session_start();

$isLogged = isset($_SESSION['token']);

$nomeUsuario = '';

if ($isLogged && isset($_SESSION['nome_usuario'])) {
    $nomeUsuario = $_SESSION['nome_usuario'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
            overflow: hidden;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .user-greeting {
            color: #2980b9;
            font-size: 1.8em;
            margin-bottom: 30px;
        }

        .user-greeting em {
            font-weight: bold;
            color: #34495e; 
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            background-color: rgba(44, 62, 80, 0.9); 
            padding: 15px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px); 
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        nav a:hover {
            background-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        nav a:active {
            background-color: #2980b9;
            transform: translateY(0);
        }
    </style>
    <title>Home</title>
</head>
<body>
    
    <?php if ($isLogged): ?>
        <h1 class="user-greeting">Bem-vindo ao sistema, <em> <?php echo htmlspecialchars($nomeUsuario); ?></em>!</h1>
    <?php else: ?>
        <h1>Bem-vindo ao sistema!</h1>
    <?php endif; ?>        
    <nav>
        <?php if ($isLogged): ?>
            <a href="./produtos/listar.php">Ver Produtos</a>
            <a href="usuario.php">Minha Conta</a>
            <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="cadastro.php">Cadastrar</a>
        <?php endif; ?>
    </nav>

</body>
</html>