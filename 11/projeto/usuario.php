<?php
// views/listar_usuarios.php
session_start();
require_once './dao/UsuarioDAO.php';
require_once './model/Usuario.php'; // Certifique-se de incluir a classe Usuario

// Redireciona se não houver token de sessão (usuário não logado)
if (!isset($_SESSION["token"])) {
    header("Location: index.php"); // Ou login.php, dependendo do seu fluxo
    exit();
}

$dao = new UsuarioDAO();

// Obtém o usuário logado para saber seu ID
$currentUser = $dao->getByToken($_SESSION["token"]);

// Se o usuário logado não for encontrado (token inválido/expirado), redireciona para login
if (!$currentUser) {
    $_SESSION['token'] = null; // Limpa o token inválido
    header('Location: login.php');
    exit();
}

$usuarios = [$currentUser];

// Lógica para mensagens de status (sucesso/erro)
$status_message = '';
if (isset($_GET['status']) && isset($_GET['message'])) {
    $status_type = $_GET['status'] === 'success' ? 'green' : 'red';
    $status_message = "<p style='color: {$status_type};'>" . htmlspecialchars($_GET['message']) . "</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="produtos/css/style.css">
</head>
<body>
    <h1>Lista de Usuários</h1>
    <?= $status_message ?>
    
    <p><a href="cadastrar_usuario.php">Novo Usuário</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($usuarios)): ?>
                <tr>
                    <td colspan="4">Nenhum usuário cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario->getId() ?></td>
                        <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                        <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                        <td>
                            <?php 
                            // Verifica se o ID do usuário na linha atual é igual ao ID do usuário logado
                            if ($usuario->getId() === $currentUser->getId()): 
                            ?>
                                <a href="edit.php?id=<?= $usuario->getId() ?>">Editar</a>
                                | <a href="delete.php?id=<?= $usuario->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir sua própria conta?');">Excluir Minha Conta</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="index.php">Voltar para o Início</a>
</body>
</html>