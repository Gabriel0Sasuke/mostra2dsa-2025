<?php
session_start();
$senhaadmin = 'b&st2nds@!';
$nomeadmin = $_SESSION['nomeadmin'] ?? null;
$loginadmin = $_SESSION['loginadmin'] ?? null;

$sql = new mysqli('localhost', 'root', '', 'mostra2025');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nomeadmin'] = $_POST['nome'];
    $_SESSION['loginadmin'] = $_POST['senha'];

    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="../../css/admin.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin🛡️</title>
</head>
<body>
    <?php 
    if ($loginadmin ==  null ||$loginadmin != $senhaadmin) { ?>
      <div id="adminlogin">
    <form action="admin.php" method="post">
        <h3>Bem vindo a Area Admin</h3>
        <label for="nome">Digite seu Nome</label>
      <input type="text" name="nome" placeholder="Seu nome verdadeiro viu" required maxlength="15">
        <label for="senha">Digite sua senha</label>
      <input type="password" name="senha" placeholder="Digite a senha" required maxlength="20">
        <button type="submit">Entrar</button>
      </form>
    </div>
    
   <?php } else if ($loginadmin === $senhaadmin){ ?>
      <main>
        <h2>Bem vindo, <?php echo $nomeadmin ?></h2>

        <div class="blocos" id="bloco1">

          <div class="infos">Número de Visitas 
            <div>
              <?php
              $numero_acessos = $sql->query("SELECT COUNT(*) as total FROM acessos")->fetch_assoc()['total'];
              echo $numero_acessos;
              ?>
          </div>
        </div>

          <div class="infos">Navegador mais Utilizado 
            <div>
              <?php
$navegador_mais_utilizado = $sql->query("
    SELECT navegador, COUNT(*) as total 
    FROM acessos 
    GROUP BY navegador 
    ORDER BY total DESC 
    LIMIT 1
")->fetch_assoc()['navegador'];

// Limitar a quantidade de caracteres
$max = 70; // ajuste o número conforme precisar
if (strlen($navegador_mais_utilizado) > $max) {
    $navegador_mais_utilizado = substr($navegador_mais_utilizado, 0, $max) . '...';
}
echo $navegador_mais_utilizado;
?>
          </div> 
        </div>

        </div>

        <div class="blocos">

        </div>

        <div class="blocos">

        </div>
        <div class="blocos">
        
            <div id="voltar" onclick=sair(1) class="botoesair">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
        </div>

        <div id="logout" onclick=sair(2) class="botoesair">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
        </div>
        </div>

       </main>
    <?php } ?>
        
    <script src="../../js/admin.js"></script>
</body>
</html>