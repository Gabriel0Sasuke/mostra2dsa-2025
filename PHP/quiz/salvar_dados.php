<?php
session_start();
if ($_SESSION['enviado_ao_servidor'] === false) {
    $nome = $_SESSION['nome'];
    $pontuacao = $_SESSION['pontuacao'];
    $tempo_segundos = $_SESSION['tempo_segundos'];

    $conn = new mysqli('localhost', 'root', '', 'mostra2025');

    $sql = "INSERT INTO tabela (nome, pontuacao, tempo_gasto_segundos) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nome, $pontuacao, $tempo_segundos);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    $_SESSION['enviado_ao_servidor'] = true;
}
    header("Location: quiz.php");
    exit();
?>