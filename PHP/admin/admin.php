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

$perguntas = $sql->query("SELECT * FROM perguntas");
$imagens = $sql->query("SELECT * FROM makeoff");
?>
<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="../../css/admin.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mostra - Admin</title>
</head>

<body>
  <?php
  if ($loginadmin == null || $loginadmin != $senhaadmin) { ?>
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

  <?php } else if ($loginadmin === $senhaadmin) { ?>
      <main>
        <h2>Bem vindo, <?php echo $nomeadmin ?></h2>

        <form id="perguntafixed" action="pergunta.php" method="post">
          <h1>Adicionar Pergunta</h1>

          <label for="pergunta">Digite a Pergunta</label>
          <input type="text" name="pergunta" placeholder="Digite a pergunta" required maxlength="150">

          <label for="resposta1">Resposta 1</label>
          <input type="text" name="resposta1" placeholder="Digite a resposta 1" required maxlength="50">
          <div class="correta">
            Resposta Correta?
            <input type="radio" name="correta" value="1" required>
          </div>

          <label for="resposta2">Resposta 2</label>
          <input type="text" name="resposta2" placeholder="Digite a resposta 1" required maxlength="50">
          <div class="correta">
            Resposta Correta?
            <input type="radio" name="correta" value="2" required>
          </div>

          <label for="resposta3">Resposta 3</label>
          <input type="text" name="resposta3" placeholder="Digite a resposta 1" required maxlength="50">
          <div class="correta">
            Resposta Correta?
            <input type="radio" name="correta" value="3" required>
          </div>

          <label for="resposta4">Resposta 4</label>
          <input type="text" name="resposta4" placeholder="Digite a resposta 1" required maxlength="50">
          <div class="correta">
            Resposta Correta?
            <input type="radio" name="correta" value="4" required>
          </div>

          <button type="button" onclick="perguntas(2)">Fechar Formulario</button>
          <button type="submit">Adicionar Pergunta</button>
        </form>

        <div id="visualizarpergunta">
          <div>
            <h1>Visualizar Perguntas</h1>

          <?php if ($perguntas->num_rows === 0) {
            echo "<h3 id='table'>Nenhuma pergunta cadastrada</h3>";
          } else { ?>
              <table>

                <tr>
                  <th>ID</th>
                  <th>PERGUNTA</th>
                  <th>AUTOR</th>
                  <th>Ação</th>
                </tr>

              <?php while ($perguntafetch = $perguntas->fetch_array()) {
                $perguntaid = $perguntafetch['id'];
                $perguntatexto = $perguntafetch['texto_pergunta'];
                $perguntaautor = $perguntafetch['autor_pergunta'];
                ?>
                  <tr class="tr-pergunta">
                    <td><?php echo $perguntaid ?></td>
                    <td><?php echo $perguntatexto ?></td>
                    <td><?php echo $perguntaautor ?></td>
                    <td><a href="excluir_pergunta.php?id=<?php echo $perguntaid ?>">Excluir</a></td>
                  </tr>
                  <?php
                  $respostas = $sql->query("SELECT * FROM respostas WHERE id_pergunta = $perguntaid");

                  ?>
                  <tr class="tr-detalhes hidden">
                    <td colspan="6" class="td-detalhes">
                      <table class="sub-table">
                        <tr>
                          <th>ID</th>
                          <th>Texto da Resposta</th>
                          <th>É a Correta?</th>
                        </tr>
                      <?php while ($respostafetch = $respostas->fetch_array()) {
                        $respostaid = $respostafetch['id'];
                        $respostatexto = $respostafetch['texto_resposta'];
                        $respostacorreta = $respostafetch['correta'];
                        ?>
                          <tr>
                            <td><?php echo $respostaid ?></td>
                            <td><?php echo $respostatexto ?></td>
                            <td>
                              <?php
                              if ($respostacorreta == 1) {
                                echo "Sim✅";
                              } else {
                                echo "Não❌";
                              }
                              ?>
                            </td>
                          </tr>
                      <?php } ?>
                      </table>
                    </td>
                  </tr>
              <?php } ?>
              </table>
          <?php } ?>
          </div>
          <button onclick="visualizarperguntas(2)">Voltar</button>
        </div>

        <div id="inseririmagem">
          <div id="titulo">Making of</div>
          <form action="imgens.php" method="post" id="arrumando_coisax" enctype="multipart/form-data">
            <p>Imagem:</p>
            <input type="file" name="imagem" class="size" required>
            <p id="erro">Grupo:</p>
            <select name="grupo" id="" class="size" required>
              <option value="" hidden>Selecione:</option>
              <option value="Parede TNT">Parede TNT</option>
              <option value="Vídeo">Vídeo</option>
              <option value="Espaço comida">Espaço comida</option>
              <option value="Parede interna">Parede interna</option>
              <option value="Parede externa">Parede externa</option>
              <option value="Personagem">Personagem</option>
              <option value="Comida">Comida</option>
              <option value="Porta">Porta</option>
              <option value="Portfólio">Portfólio</option>
              <option value="Pôster">Pôster</option>
            </select>
            <p>Legenda:</p> <textarea name="legenda" id="legenda" class="size" maxlength="255" required></textarea>
            <button type="submit" id="submit">Adicionar Imagem</button>
          </form>
          <button onclick="inseririmagens(2)">Voltar</button>
        </div>
        <div id="visualizarimagem">
          <div>
          <div id="titulo">Visualizar Imagem</div>
            <table>
              <tr>
              <th>ID</th>
              <th>Imagem</th>
              <th>Grupo</th>
              <th>Legenda</th>
              <th>Autor</th>
              <th>Ação</th>
            <?php
            while ($row_imagem = $imagens->fetch_array()) { ?>
              <tr>
                    <td><?php echo $row_imagem['id']; ?></td>
                    <td><img src='../../<?php echo $row_imagem['caminho_arquivo']; ?>' alt='Imagem' id='size_img'/></td>
                    <td><?php echo $row_imagem['grupo']; ?></td>
                    <td><?php echo $row_imagem['legenda']; ?></td>
                    <td><?php echo $row_imagem['autor']; ?></td>
                    <td><a href="excluir.php?id=<?php echo $row_imagem['id']; ?>">Excluir</a></td>
              <tr>
              <?php }
            ?>
            </tr>
          </table>
        </div>
          <button id="volte" onclick="visualizarimagens(2)">Voltar</button>
        </div>
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

        <div class="blocos" id="perguntas" onclick="perguntas(1)">
          Criar Pergunta e Respostas
        </div>

        <div class="blocos" id="perguntas" onclick="visualizarperguntas(1)">
          Visualizar Pergunta e Respostas
        </div>

        <div class="blocos" id="perguntas" onclick="inseririmagens(1)">
          Inserir Imagens do Making Of
        </div>
        <div class="blocos" id="perguntas" onclick="visualizarimagens(1)">
          Visualizar Imagens do Making Of
        </div>

        <div class="blocos">
          <div id="voltar" onclick=sair(1) class="botoesair">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
              <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
            </svg>
          </div>

          <div id="logout" onclick=sair(2) class="botoesair">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
              <path
                d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
            </svg>
          </div>
        </div>

      </main>
  <?php } ?>

  <script src="../../js/admin.js"></script>
</body>

</html>