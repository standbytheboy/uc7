<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Acess-Control-Allow-Headers: Content-Type');
require_once __DIR__ .'/../dao/ProdutoDAO.php';
require_once __DIR__ .'/../model/Produto.php';

$dao = new ProdutoDAO();
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
$inputData = json_decode(file_get_contents('php://input'), true);

switch ($action) {
    case 'listar':
        echo json_encode($dao->getAll());
        break;

    case 'buscar':
        if ($id) {
            $produto = $dao->getById($id);
            if ($produto) { echo json_encode($produto);}
            else { http_response_code(404); echo json_encode(["error" => "Produto não encontrado!"]); }
        } 
        
        else { http_response_code(400); echo json_encode(["error"=> "Você não informou o ID"]); }
        break;

    case "cadastrar":
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $inputData) {
            $produto = new Produto(
                ($inputData['id'] ?? null),
                ($inputData['preco'] ?? null),
                ($inputData['ativo'] ?? null),
                ($inputData['dataDeCadastro'] ?? null),
                ($inputData['dataDeValidade'] ?? null)
            );
        }

        if($dao->create($produto)) {
            http_response_code(200); echo json_encode(['message'=> 'Cliente Cadastrado com Sucesso']); }
        else {
            http_response_code(500); echo json_encode(['error'=> 'Erro ao Cadastrar o Cliente']); }
    break;

    case 'atualizar': 
        if ($id && $_SERVER['REQUEST_METHOD'] == 'PUT'&& $inputData) {
            $produto = new Produto(
                $id,
                ($inputData['nome'] ?? null),
                ($inputData['preco'] ?? null),
                ($inputData['ativo'] ?? null),
                ($inputData['dataDeCadastro'] ?? null),
                ($inputData['dataDeValidade'] ?? null)
            );

            if($dao->update($produto)) {
                http_response_code(204); echo json_encode(['message'=> 'Cliente Atualizado Com Sucesso!']); 
            } else { http_response_code(500); echo json_encode(['error' => 'Erro ao Atualizar o Cliente']); }
        }
        else { http_response_code(400); echo json_encode(['error'=> 'ID não fornecido ou método incorreto']); }
    break;

    case 'excluir':
        if ($id && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
            if($dao->delete($id)) {echo json_encode(['message'=> 'Produto Excluído!']); } 
            else { http_response_code(500); echo json_encode(['error'=> 'Erro ao Excluir!']); }
        } 

        else { http_response_code(400); echo json_encode(['error' => 'ID não fornecido ou método incorreto']); }
    break;

    default:
    http_response_code(400); echo json_encode(['error'=> 'Ação inválida, informar action']);
    break;
}