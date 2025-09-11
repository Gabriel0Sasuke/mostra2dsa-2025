<?php
    require_once __DIR__ . '/../../include/conn.php';
    if(isset($_GET['id'])){
        $imagem_recebida = $_GET['id'];
    }
    else {
        echo"Oxe fi, como ce entrou aqui?";
    }
    $imagem = "SELECT * FROM makeoff WHERE id = $imagem_recebida";
    $result = $conn->query($imagem);
    while ($row = $result->fetch_assoc()) {
        $grupo = $row['grupo'];
        $arquivo = $row['caminho_arquivo'];
        $desc = $row['legenda'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../css/sobre_img.css">
</head>
<body>
        <h1><?php echo $grupo ?></h1>
    <div id="fundo">
        <div id="img_fundo">
            <img src="../../<?php echo "$arquivo"; ?>" alt="">
        </div>
        <h2>Descrição</h2>
        <div id="sinopse">
            <?php echo "$desc" ?>
        </div>
    </div>
    <button id="back" onclick="window.location='sobre.php'">voltar</button>
</body>
</html>