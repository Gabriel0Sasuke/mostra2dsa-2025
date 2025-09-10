<?php
session_start();
unset($_SESSION['nome']);
unset($_SESSION['perguntas_quiz']);
unset($_SESSION['vidas']);
unset($_SESSION['pontuacao']);
unset($_SESSION['current_question']);
unset($_SESSION['tempo_segundos']);
unset($_SESSION['enviado_ao_servidor']);

header('Location: quiz.php');
exit();
?>