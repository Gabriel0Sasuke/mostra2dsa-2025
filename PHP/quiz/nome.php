<?php
session_start();

// Limpa estado anterior para iniciar um novo quiz preservando só o nome novo
unset($_SESSION['perguntas_quiz']);
unset($_SESSION['vidas']);
unset($_SESSION['pontuacao']);
unset($_SESSION['current_question']);
unset($_SESSION['tempo_segundos']);

$nome = isset($_POST['nome']) ? trim($_POST['nome']) : 'Jogador';
$_SESSION['nome'] = $nome === '' ? 'Jogador' : $nome;

header("Location: quiz.php");
exit();
?>