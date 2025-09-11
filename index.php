<?php
session_start();
require_once __DIR__ . '/include/conn.php';


if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] === false){
$ip = $_SERVER['REMOTE_ADDR'];
$navegador = $_SERVER['HTTP_USER_AGENT'];

// Registrar acesso
$stmt = $conn->prepare("INSERT INTO acessos (navegador, ip) VALUES (?, ?)");
$stmt->bind_param("ss", $navegador, $ip);
$stmt->execute();
$stmt->close();
$_SESSION['acesso'] = true;
header("Location: index.php");
exit();
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!preg_match('/Mobi|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $user_agent)) {
  // Redireciona para uma página de erro
  header('Location: html/erro.html');
  exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <main>
        <div id="knif">
            <img src="images/faca.png" alt="">
        </div>
        
        <div id="title">
            <div id="txt">Mostra 2025</div>
            <img src="images/acima do texto.png" alt="">
        </div>
        <div id="sub-title">
            Suspense
        </div>
        <div id="detetive">
            <img src="images/detetive.png" onclick="admin()">
        </div>
        <div id="btns">
            <button class="btn" id="btn1" onclick="window.location ='PHP/quiz/quiz.php'"><p>Quiz</p></button>
            <button class="btn" id="btn2" onclick="window.location ='PHP/makeoff/sobre.php'"><p>Making of</p></button>
            <button class="btn" id="btn3" onclick="window.location ='PHP/sobre/hitchcock.php'"><p>Sobre Hitchcock</p></button>
        </div>
    </main>
    <footer>
        <div id="fr">
            eLE ESTÁ SEMPRE TE OBSERVANDO...
        </div>
        <div id="pe">
            - ALFRED HITCHCOCK
        </div>
        <div id="sala" onclick="paginanova()">
            2DSA
        </div>
    </footer>
    <script src="js/index.js"></script>
</body>
</html>
