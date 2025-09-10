<?php
session_start();

// Pega o corpo da requisição (que é um JSON enviado pelo JavaScript)
$json_data = file_get_contents('php://input');

// Decodifica o JSON para um array associativo
$data = json_decode($json_data, true);

// Verifica se os dados necessários foram recebidos e atualiza a sessão
if (isset($data['vidas'], $data['pontuacao'], $data['indiceAtual'], $data['tempo'])) {
    $_SESSION['vidas'] = (int)$data['vidas'];
    $_SESSION['pontuacao'] = (int)$data['pontuacao'];
    $_SESSION['current_question'] = (int)$data['indiceAtual'];
    $_SESSION['tempo_segundos'] = (int)$data['tempo'];

    // Responde com um status de sucesso (bom para depuração)
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Estado salvo com sucesso.']);
} else {
    // Responde com um erro se os dados estiverem incompletos
    http_response_code(400); // Bad Request
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Dados incompletos para salvar o estado.']);
}
?>
