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
    case 'buscar':
        echo json_encode("Chamou o buscar");
        break;
    case 'cadastrar':
        echo json_encode("Chamou o cadastrar");
        break;
    case 'atualizar':
        echo json_encode("Chamou o atualizar");
        break;
    case 'excluir':
        echo json_encode("Chamou o excluir");    
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida, informar action']);
        break;
}