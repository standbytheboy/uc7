 // pega os dados da requisição "body", o "decode" "descriptografa" a informação. o diretório "php://input" é o local padrão que fica o "body", onde ficam os dados sensíveis
<?php
header('Content-Type: application/json');

// Simulação de Dados
$pessoas = [
    ['id' => 1, 'nome' => 'João'],
    ['id' => 2, 'nome' => 'Maria'],
    ['id' => 3, 'nome' => 'José'],
];

$rota = $_GET['rota'] ?? '';

$metodo = $_SERVER['REQUEST_METHOD'];

// echo json_encode("Olá cliente, vc acesscou com o método " . $metodo);

if($metodo == 'GET' && $rota == 'ola') {
    echo json_encode(['mensagem' => "Olá Mundo"]);
    exit;
}

if ($metodo == 'POST' && $rota == 'ola-nome') {
    $nome = $_GET['nome'];
    echo json_encode(['mensagem' => "Olá, $nome"]);
    exit;
}

if ($metodo == 'GET' && $rota == 'pessoas') {
    echo json_encode($pessoas);
    exit;
}

if($metodo == 'POST' && $rota == 'cadastrar-url')
{
    $id = $_GET['id'] ?? null;
    $nome = $_GET['nome'] ?? null;

    if(!$id || !$nome)
    {
        echo json_encode(['erro' => 'Informe o id e nome na URL']);
        exit;
    }

    $pessoas[] = ['id' => (int)$id, 'nome' => $nome];

    echo json_encode([
        'mensagem' => 'Pessoa cadastrada com sucesso!',
        'pessoas' => $pessoas
    ]);
    exit;
}

if($metodo == 'POST' && $rota == 'cadastrar-body')
{
    $input = json_decode(file_get_contents('php://input'), true);

    $id = $input['id'] ?? null;
    $nome = $input['nome'] ?? null;

    if(!$id || !$nome)
    {
        echo json_encode(['erro' => 'Informe o id e nome na URL']);
        exit;
    }

    $pessoas[] = ['id' => (int)$id, 'nome' => $nome];

    echo json_encode([
        'mensagem' => 'Pessoa cadastrada com sucesso!',
        'pessoas' => $pessoas
    ]);
    exit;
}

// boa prática
http_response_code(404);
echo json_encode(['erro' => 'Rota não encontrada']);