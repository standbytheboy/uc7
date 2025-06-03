<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../dao/ClienteDAO.php';
require_once __DIR__ . '/../model/Cliente.php';

$dao = new ClienteDAO();
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
$inputData = json_decode(file_get_contents('php://input'), true); // pega os dados do body da requisição

switch ($action)
{
    case 'listar':
        echo json_encode($dao->getAll());
        break;

    case 'buscar':
        if($id) {   
            $cliente = $dao->getById($id);
            if($cliente){ echo json_encode($cliente); } 
            else { http_response_code(404); echo json_encode(["error" => "Cliente não encontrado!"]); }
        } else { 
            http_response_code(400); 
            echo json_encode(["error" => "Você não informou o ID"]);
        }
        break;

    case 'cadastrar':
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $inputData) {
        $cliente = new Cliente(
            ($inputData['id'] ?? null),
            ($inputData['nome'] ?? ''),
            ($inputData['cpf'] ?? ''),
            ($inputData['active'] ?? ''),
            ($inputData['birthDate'] ?? '')
        ); 
        
        if ($dao->create($cliente)) {
            echo json_encode(['message' => 'Cliente cadastrado com sucesso!']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao cadastrar o cliente']);
        }
    }
        else { http_response_code(400); echo json_encode(['error' => 'ID não fornecido ou método incorreto']); }
        break;

    case 'atualizar':
        echo json_encode("Chamou o atualizar");
        break;

    case 'excluir':
        if ($id && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
            if ($dao->delete($id)) { echo json_encode(['message' => 'Cliente excluído!']); } 
            else { http_response_code(500); echo json_encode(['error' => 'Erro ao excluir!']); }
        } else {
            http_response_code(400); 
            echo json_encode(['error' => 'ID não fornecido ou método incorreto']); 
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida, informar action']);
        break;
}