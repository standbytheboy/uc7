<?php
session_start();
require_once './dao/UsuarioDAO.php';

if(isset($_SESSION['token']))
{
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');

    $dao = new UsuarioDAO();
    $usuario = $dao->getByEmail($email);

    if($usuario && password_verify($senha, $usuario->getSenha()))
    {
        $token = bin2hex(random_bytes(25)); // gera um token a cada nova sessão
        $_SESSION['token'] = $token;
        $dao->updateToken($usuario->getId(), $token);
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $error = "Email ou senha inválidos!";
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
<h1>Login</h1>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button type="submit">Entrar</button>
</form>
<a href="cadastro.php">Não tem conta? Crie agora</a>

</body>
</html>