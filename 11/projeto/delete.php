<?php
session_start();
require_once './dao/UsuarioDAO.php';

if (!isset($_SESSION["token"])) {
    header("Location: index.php");
    exit();
}

$dao = new UsuarioDAO();
$message = '';
$status = 'error';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        if ($dao->delete($id)) {
            $message = 'Usuário excluído com sucesso!';
            $status = 'success';
        } else {
            $message = 'Erro ao excluir o usuário.';
        }
    } else {
        $message = 'ID de usuário inválido.';
    }
} else {
    $message = 'Nenhum ID de usuário fornecido para exclusão.';
}

header("Location: listar_usuarios.php?status={$status}&message=" . urlencode($message));
exit();
?>