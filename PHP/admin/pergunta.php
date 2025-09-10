<?php
session_start();
require_once __DIR__ . '/../../include/conn.php';

$pergunta = $_POST['pergunta'] ?? null;

$resposta1 = $_POST['resposta1'] ?? null;
$resposta2 = $_POST['resposta2'] ?? null;
$resposta3 = $_POST['resposta3'] ?? null;
$resposta4 = $_POST['resposta4'] ?? null;

$correta = $_POST['correta'] ?? null; // Aqui virá o valor 1, 2, 3 ou 4 do HTML

$resposta1_correta = false;
$resposta2_correta = false;
$resposta3_correta = false;
$resposta4_correta = false;

if ($correta == 1) {
    $resposta1_correta = true;
} else if ($correta == 2) {
    $resposta2_correta = true;
} else if ($correta == 3) {
    $resposta3_correta = true;
} else if ($correta == 4) {
    $resposta4_correta = true;
}
$nome_autor = $_SESSION['nomeadmin'];
//Inserindo a Pergunta

$sql_pergunta = "INSERT INTO perguntas (texto_pergunta, autor_pergunta) VALUES (?, ?)";
$stmt_pergunta = $conn->prepare($sql_pergunta);

$stmt_pergunta->bind_param("ss", $pergunta, $nome_autor);

if ($stmt_pergunta->execute()) {
    $id_nova_pergunta = $conn->insert_id;

    //Inserindo as Respostas

    $sql_resposta = "INSERT INTO respostas (id_pergunta, texto_resposta, correta) VALUES (?, ?, ?)";
    $stmt_resposta = $conn->prepare($sql_resposta);

    // Resposta 1
    $stmt_resposta->bind_param("isi", $id_nova_pergunta, $resposta1, $resposta1_correta);
    $stmt_resposta->execute();
    
    // Resposta 2
    $stmt_resposta->bind_param("isi", $id_nova_pergunta, $resposta2, $resposta2_correta);
    $stmt_resposta->execute();

    // Resposta 3
    $stmt_resposta->bind_param("isi", $id_nova_pergunta, $resposta3, $resposta3_correta);
    $stmt_resposta->execute();

    // Resposta 4
    $stmt_resposta->bind_param("isi", $id_nova_pergunta, $resposta4, $resposta4_correta);
    $stmt_resposta->execute();

    $stmt_pergunta->close();
    $stmt_resposta->close();
    
    header("Location: admin.php"); 
    exit();

} else {
    echo "Erro ao inserir a pergunta: " . $stmt_pergunta->error;
}

$conn->close();

?>