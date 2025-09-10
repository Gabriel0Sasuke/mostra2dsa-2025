<?php
$conn = new mysqli('localhost', 'root', '', 'mostra2025');

$sql = "SELECT nome, pontuacao, data_hora, tempo_gasto_segundos FROM tabela ORDER BY pontuacao DESC, tempo_gasto_segundos ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra - Classificação</title>
    <link rel="stylesheet" href="../../css/classifica.css">
</head>

<body>
    <main>
        <img src="../../images/faca.png" id="faca">
        <img src="../../images/detetive.png" id="escuro">
        <h1>Quiz</h1>
        <h2>Placar</h2>

        <div id="tabela">
            <?php if($result->num_rows > 0){ ?>
        <table>
            <tr>
                <th>Nº</th>
                <th>Nome</th>
                <th>Pontuação</th>
                <th>Data</th>
                <th>Tempo</th>
            </tr>
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) { $i++; ?>
                <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["nome"]; ?></td>
                <td><?php echo $row["pontuacao"]; ?></td>
                <td><?php echo $row["data_hora"]; ?></td>
                <td><?php echo $row["tempo_gasto_segundos"]; ?></td>
                </tr>
                <?php }
            ?>
        </table>
        <?php } else{
            echo"Parece que ninguem fez ainda, você pode ser o primeiro";
        } ?>
    </div>

    </main>
    <button onclick="window.location='../../index.php'" id="back">Voltar ao Inicio</button>
</body>

</html>