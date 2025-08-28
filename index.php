<?php
session_start();
$sql = new mysqli('localhost', 'root', '', 'mostra2025');

if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] === false){
$ip = $_SERVER['REMOTE_ADDR'];
$navegador = $_SERVER['HTTP_USER_AGENT'];

// Registrar acesso
$stmt = $sql->prepare("INSERT INTO acessos (navegador, ip) VALUES (?, ?)");
$stmt->bind_param("ss", $navegador, $ip);
$stmt->execute();
$stmt->close();
$_SESSION['acesso'] = true;
header("Location: index.php");
exit();
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra 2DSA</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div id="centraliza">
        <div id="name_space">
            mostra 2025&nbsp;&nbsp;&nbsp;
            <img src="images/detetive.png" onclick="admin()">
        </div>
        SUSPENSE
        
        <div class="button">
            <a href="PHP/quiz/quiz.php">
                quiz
            </a>
            <a href="PHP/makeoff/sobre.php">
                makeoff
            </a>
            <a href="PHP/sobre/hitchcock.php">
                sobre Hitchcock
            </a>
        </div>

        <div id="sala" onclick="paginanova()">
            2dsa
        </div>
        <div id="down">
            ele está sempre te observando... <br>
            -alfred Hitchcock
        </div>
    </div>
    <script src="js/index.js"></script>
</body>

</html>
