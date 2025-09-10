<?php
session_start();
require_once __DIR__ . '/../../include/conn.php';
if (isset($_SESSION['enviado_ao_servidor']) && $_SESSION['enviado_ao_servidor'] === false) {
    $nome = $_SESSION['nome'] ?? '';
    $pontuacao = (int)($_SESSION['pontuacao'] ?? 0);
    $tempo_segundos = (int)($_SESSION['tempo_segundos'] ?? 0);
    if ($stmt = $conn->prepare("INSERT INTO tabela (nome, pontuacao, tempo_gasto_segundos) VALUES (?, ?, ?)")) {
        $stmt->bind_param("sii", $nome, $pontuacao, $tempo_segundos);
        $stmt->execute();
        $stmt->close();
        $_SESSION['enviado_ao_servidor'] = true;
    }
}
header('Location: quiz.php');
exit();
?>