<?php
// views/editar_usuario.php
session_start();
require_once './dao/UsuarioDAO.php';
require_once './model/Usuario.php';

if (!isset($_SESSION["token"])) {
    header("Location: index.php");
    exit();
}

$dao = new UsuarioDAO();
$usuario = null;
$error = '';
$success = '';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        $usuario = $dao->getById($id);
        if (!$usuario) {
            $error = 'Usuário não encontrado.';
        }
    } else {
        $error = 'ID de usuário inválido.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $usuario) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? ''; // Senha é opcional na edição

    if (!$id || empty($nome) || empty($email)) {
        $error = 'Dados inválidos. Verifique todos os campos obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Formato de e-mail inválido.';
    } else {
        // Obter o usuário atual para comparar o email
        $current_user = $dao->getById($id);
        if ($current_user && $current_user->getEmail() !== $email) {
            if ($dao->getByEmail($email)) {
                $error = 'Este novo e-mail já está em uso por outro usuário.';
            }
        }

        if (empty($error)) {
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            if (!empty($senha)) { // Só atualiza a senha se um valor for fornecido
                $usuario->setSenha($senha);
            }

            if ($dao->update($usuario)) {
                $success = 'Usuário atualizado com sucesso!';
                // Recarrega o objeto do usuário para refletir as mudanças no formulário
                $usuario = $dao->getById($id); 
            } else {
                $error = 'Erro ao atualizar o usuário. Tente novamente.';
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
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <?php if ($usuario): ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $usuario->getId() ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario->getNome()) ?>" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario->getEmail()) ?>" required><br><br>

            <label for="senha">Nova Senha (deixe em branco para não alterar):</label>
            <input type="password" id="senha" name="senha"><br><br>

            <button type="submit">Salvar Alterações</button>
        </form>
    <?php endif; ?>
    <br>
    <a href="usuario.php">Voltar para a lista</a>
</body>
</html>