<?php
$conn = new mysqli('localhost', 'root', '', 'mostra2025');
$sql = "SELECT * FROM makeoff";
$result = $conn->query($sql);
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
        <div id="parede_externa">
            <h2>Parede Externa</h2>
            <div class="producao">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Parede Externa") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="porta">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Porta") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="parede_interna">
            <h2>Parede Interna</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Parede Interna") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="parede_tnt">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Parede de TNT") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Porta") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="p_porta">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Porta") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="p_porta">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Porta") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="p_porta">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Porta") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
        <div id="p_porta">
            <h2>Porta</h2>
            <div class="producao">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['grupo'] == "Porta") {
                            echo "<img src='$row[caminho_arquivo]'>";
                        }
                    }
                } else {
                    echo "não há imagem desse grupo";
                }
                ?>
                <img src="../../images/birdu.png" alt="">
            </div>
        </div>
    </div>
</body>

</html>