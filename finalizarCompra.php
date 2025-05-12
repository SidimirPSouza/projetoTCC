<?php
header("Content-Type: application/json");

// Inclua a configuração do banco de dados
include('config.php');

// Obtém os dados do carrinho enviados pelo cliente
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Dados inválidos."]);
    exit;
}

// Verifica o estoque de cada produto antes de atualizar
foreach ($data as $codproduto => $item) {
    $qtde = $item["quantity"];

    // Consulta o estoque atual do produto
    $sql = "SELECT qtde FROM tbprodutos WHERE codproduto = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $codproduto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Produto $codproduto não encontrado."]);
        $stmt->close();
        $conexao->close();
        exit;
    }

    $produto = $result->fetch_assoc();

    // Verifica se há estoque suficiente
    if ($produto['qtde'] < $qtde) {
        echo json_encode([
            "success" => false,
            "message" => "Estoque insuficiente para o produto $codproduto. Estoque disponível: {$produto['qtde']}."
        ]);
        $stmt->close();
        $conexao->close();
        exit;
    }
}

// Atualiza a quantidade no banco de dados após a verificação de estoque
foreach ($data as $codproduto => $item) {
    $qtde = $item["quantity"];

    $sql = "UPDATE tbprodutos SET qtde = qtde - ? WHERE codproduto = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $qtde, $codproduto);

    if (!$stmt->execute()) {
        echo json_encode(["success" => false, "message" => "Erro ao atualizar o produto $codproduto."]);
        $stmt->close();
        $conexao->close();
        exit;
    }
}

// Retorna sucesso se todos os produtos foram atualizados corretamente
echo json_encode(["success" => true, "message" => "Compra finalizada com sucesso."]);
$stmt->close();
$conexao->close();
?>
