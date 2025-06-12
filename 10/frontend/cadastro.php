<?php
session_start();
require_once '../dao/UsuarioDAO.php';
require_once '../model/Usuario.php';

$dao = new UsuarioDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $verifyPass = filter_input(INPUT_POST, 'verifyPass');
    
    if ($password !== $verifyPass || !$name || !$email || !$password || !$verifyPass) {
        $error = 'Dados inválidos ou senhas não conferem.';
    } else {

        if($dao->getByEmail($email)) {
            $error = "Já existe usuário com esse email.";
        } 
        else {
            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(25));
            $usuario = new Usuario(null, $name, $email, $passHash, $token);

            if($dao->create($usuario)) {
                header('Location: index.php');
                exit();
            } 
            
            else {
                $error = 'Erro ao cadastrar o usuário!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h1>Cadastro</h1>

<form action="" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    
    <label for="password">Senha:</label>
    <input type="password" name="password" required>
    
    <label for="verifyPass">Confirmar Senha:</label>
    <input type="password" name="verifyPass" required>
    <?php if(isset($error)) echo "<p style='color: red'>$error</p>"; ?>
    
    <button type="submit">Cadastrar</button>
</form>

<a href="login.php">Já tem conta?</a>
</body>
</html>