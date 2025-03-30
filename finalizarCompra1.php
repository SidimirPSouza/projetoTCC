<?php
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['cart'], $data['user'])) {
    echo json_encode(["success" => false, "message" => "Dados inválidos recebidos."]);
    exit;
}

$cart = $data['cart'];
$user = $data['user'];

// Teste de conexão com o banco de dados
if (!$conexao) {
    echo json_encode(["success" => false, "message" => "Erro na conexão com o banco de dados."]);
    exit;
}

// Calcular o total do pedido
$total = array_reduce($cart, function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);

try {
    // Preparar a instrução SQL para inserir no banco
    $stmt = $conexao->prepare("INSERT INTO pedidos (nome, email, turma, itens, total) VALUES (?, ?, ?, ?, ?)");
    
    $itens = json_encode($cart); // Serializar os itens para salvar como JSON
    $stmt->bind_param("sssds", $user['nome'], $user['email'], $user['turma'], $itens, $total);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Pedido salvo com sucesso!", "total" => $total]);
    } else {
        throw new Exception("Erro ao salvar o pedido no banco de dados.");
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>
