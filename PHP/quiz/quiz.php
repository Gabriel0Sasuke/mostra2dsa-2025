<?php
$sql = new mysqli('localhost', 'root', '', 'mostra2025');
session_start();
include "../../include/icons.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../css/quiz.css">
</head>
<body>
    <main>
        <div id="vidas"><?php echo"$heart $heart $lost_heart";?></div>
        <h1>quiz</h1>
        <div id="pergunta">Qual é o nome do filme da icônica cena de assassinato no banheiro?</div>

        <div id="respostas-container">
            <div class="resposta">Psicoce</div>
            <div class="resposta">Minecraft</div>
            <div class="resposta">Roblox</div>
            <div class="resposta">My Little Pony!</div>
        </div>

            <form action="quiz.php" method="post" id="form_nome">
                <label for="apelido">Digite seu Apelido</label>
                <br>
                ele será usado na tabela de classificação, então capriche!
                <input type="text" name="apelido" id="apelido" placeholder="Insira seu Apelido" required>
                <br>
                <button type="submit">Começar Quiz</button>
            </form>

            <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $apelido = $_POST['apelido'];

        if(empty($_SESSION['apelido'])){
        $_SESSION['apelido'] = $apelido;
    }
}
    ?>
    </main>

    <?php
        if (!empty($_SESSION['apelido'])){
     ?>   <script>
            let segundos = 0;
        document.getElementById("form_nome").style.display = "none";
    
        setInterval(() => {
            segundos++;
        }, 1000);
        </script><?php
    }?>
</body>
</html>
