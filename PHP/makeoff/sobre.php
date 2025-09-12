<?php
require_once __DIR__ . '/../../include/conn.php';
$sql = "SELECT * FROM makeoff";
$result = $conn->query($sql);
$x = 1;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra - Make Off</title>
    <link rel="stylesheet" href="../../css/making_of.css">
</head>

<body>
    <h1>Making of</h1>

    <div id="red">
        <div id="Parede TNT">
            <h2>Parede TNT</h2>
            <div class="producao">
                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Parede TNT") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Vídeo">
            <h2>Vídeo</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Vídeo") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Espaço comida">
            <h2>Espaço comida</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Espaço comida") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Parede interna">
            <h2>Parede interna</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Parede interna") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Parede externa">
            <h2>Parede externa</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Parede externa") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Personagem">
            <h2>Personagem</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Personagem") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Comida">
            <h2>Comida</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Comida") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Porta">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Porta") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Portfólio">
            <h2>Portfólio</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Portfólio") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Pôster">
            <h2>Pôster</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Pôster") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
        <div id="Componente">
            <h2>Componente</h2>
            <div class="producao">

                <?php
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['grupo'] == "Componente") {
                        ?><a href="sobre_imagem.php?id=<?php echo " $row[id] "; ?>"><img
                                src='../../<?php echo "$row[caminho_arquivo]"; ?>'></a><?php
                                  $x = 0;
                    }
                }
                if ($x === 1) {
                    echo "<p>Esse grupo não tem imagem</p>";
                }
                $x = 1;
                ?>
            </div>
        </div>
    </div>
    <button id="back" onclick="window.location='../../index.php'">Voltar ao Inicio</button>
</body>

</html>