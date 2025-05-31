<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../dao/ClienteDAO.php';

$dao = new ClienteDAO();
$action = $_GET['action'] ?? null;

switch ($action)
{
    case 'listar':
        echo json_encode($dao->getAll());
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acao inválida, informar action']);
        break;
}