<?php
session_start();

include "../../include/icons.php";

$perguntas_para_js = [];

// Garante flag de envio inicial
if (!isset($_SESSION['enviado_ao_servidor'])) {
    $_SESSION['enviado_ao_servidor'] = false;
}

// Só gera novas perguntas se o usuário já tiver nome e ainda não houver perguntas salvas na sessão
if (isset($_SESSION['nome'])) {
    if (!isset($_SESSION['perguntas_quiz'])) {
        $sql = new mysqli('localhost', 'root', '', 'mostra2025');
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sorteio = $sql->query("SELECT ID FROM perguntas ORDER BY RAND() LIMIT 10");
        if ($sorteio->num_rows > 0) {
            while ($pergunta_row = $sorteio->fetch_assoc()) {
                $id_pergunta_atual = $pergunta_row['ID'];
                $stmt_pergunta = $sql->prepare("SELECT texto_pergunta FROM perguntas WHERE id = ?");
                $stmt_pergunta->bind_param("i", $id_pergunta_atual);
                $stmt_pergunta->execute();
                $texto_pergunta = $stmt_pergunta->get_result()->fetch_assoc()['texto_pergunta'];
                // Embaralha a ordem das respostas a cada montagem de quiz
                $stmt_respostas = $sql->prepare("SELECT texto_resposta, correta FROM respostas WHERE id_pergunta = ? ORDER BY RAND()");
                $stmt_respostas->bind_param("i", $id_pergunta_atual);
                $stmt_respostas->execute();
                $respostas_result = $stmt_respostas->get_result();
                $respostas_array = [];
                $texto_correta = '';
                while ($resposta_row = $respostas_result->fetch_assoc()) {
                    $respostas_array[] = $resposta_row['texto_resposta'];
                    if ($resposta_row['correta']) {
                        $texto_correta = $resposta_row['texto_resposta'];
                    }
                }
                if (!empty($texto_pergunta) && !empty($respostas_array)) {
                    $perguntas_para_js[] = [
                        "texto" => $texto_pergunta,
                        "respostas" => $respostas_array,
                        "correta" => $texto_correta
                    ];
                }
            }
        }
        // Salva na sessão para persistir
        $_SESSION['perguntas_quiz'] = $perguntas_para_js;
        // Inicializa estado do jogo se ainda não existir
        if (!isset($_SESSION['vidas'])) $_SESSION['vidas'] = 3;
        if (!isset($_SESSION['pontuacao'])) $_SESSION['pontuacao'] = 0;
        if (!isset($_SESSION['current_question'])) $_SESSION['current_question'] = 0;
        if (!isset($_SESSION['tempo_segundos'])) $_SESSION['tempo_segundos'] = 0;
    } else {
        $perguntas_para_js = $_SESSION['perguntas_quiz'];
        // Garante existência das variáveis de estado
        if (!isset($_SESSION['vidas'])) $_SESSION['vidas'] = 3;
        if (!isset($_SESSION['pontuacao'])) $_SESSION['pontuacao'] = 0;
        if (!isset($_SESSION['current_question'])) $_SESSION['current_question'] = 0;
        if (!isset($_SESSION['tempo_segundos'])) $_SESSION['tempo_segundos'] = 0;
        if (!isset($_SESSION['enviado_ao_servidor'])) $_SESSION['enviado_ao_servidor'] = false;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra - Quiz</title>
    <link rel="stylesheet" href="../../css/quiz.css">
</head>

<body>
    <?php 
    if(!isset($_SESSION['nome'])){
        ?>
    <div id="container_inicial">
        <h1>QUIZ</h1>
        <div>
            <p>Bem vindo ao quiz!</p>
            <p>1 - Há 10 Perguntas de Conhecimento Geral sobre os filmes de Alfred Hitchcock</p>
            <p>2 - Você tem 3 vidas, a cada resposta errada você perde uma vida</p>
            <p>3 - Não Há Limite de Tempo para responder, mas os mais rapidos subirão no ranking...</p>
            <p>4 - Caso Saia, suas respostas serão salvas e você poderá retomar de onde parou.</p>
            <p>5 - Boa Sorte!</p>
        </div>
        <form action="nome.php" method="post">
            <h2>Para Começar</h2>
            <label for="nome">Digite seu nome</label>
            <input type="text" placeholder="Escolha um nome legal!" id="nome" maxlength="100" required name="nome">
            <button type="submit" id="btn-submit">Começar Jogo</button>
        </form>
        <button id="btn_classificacao" onclick="window.location.href='classificacao.php'">Acessar Classificação</button>
        <button id="btn_voltar" onclick="window.location.href='../../index.php'">Voltar pra Pagina inicial</button>
    </div>    
    <?php

    } else {
    ?>
    <img id="faca" src="../../images/faca.png" alt="">
    <h1>QUIZ</h1>

    <div id="tela-vitoria" style="display:none;">
        <h2>Você Venceu!</h2>
        <p>Parabéns, <?php echo $_SESSION['nome']; ?> você completou o quiz!</p>
        <p>Sua pontuação: <?php echo $_SESSION['pontuacao']; ?></p>
        <p>Suas vidas restantes: <?php echo $_SESSION['vidas']; ?></p>
        <p>Seu tempo: <?php echo $_SESSION['tempo_segundos']; ?> segundos</p>

        <button onclick="window.location.href='rejogar.php'">Jogar Novamente</button>
        <button onclick="window.location.href='classificacao.php'">Ver Classificação</button>
        </div>

    <div id="tela-derrota" style="display:none;">
        <h2>Você Perdeu!</h2>
        <p>Que pena, <?php echo $_SESSION['nome']; ?> você perdeu todas as vidas.</p>
        <p>Sua pontuação: <?php echo $_SESSION['pontuacao']; ?></p>
        <p>Suas vidas restantes: <?php echo $_SESSION['vidas']; ?></p>
        <p>Seu tempo: <?php echo $_SESSION['tempo_segundos']; ?> segundos</p>

        <button onclick="window.location.href='rejogar.php'">Jogar Novamente</button>
        <button onclick="window.location.href='classificacao.php'">Ver Classificação</button>
        </div>

    <div id="pergunta">

    </div>
    <img id="dete" src="../../images/detetive.png" alt="">
    <div id="respostas">
        <div class="pergunta_s">
            <button id="resposta1"></button>
            <button id="resposta2"></button>
            <button id="resposta3"></button>
            <button id="resposta4"></button>
        </div>
    </div>
    <div id="coracao"><?php echo"$heart $heart $lost_heart" ?></div>
    <div id="tempo"></div>
    <div id="pergunta-atual"></div>
    <?php
    }
    
    ?>
    
<script>
let perguntas = <?= json_encode($perguntas_para_js, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
const estadoInicial = {
    vidas: <?= isset($_SESSION['vidas']) ? (int)$_SESSION['vidas'] : 3 ?>,
    pontuacao: <?= isset($_SESSION['pontuacao']) ? (int)$_SESSION['pontuacao'] : 0 ?>,
    indiceAtual: <?= isset($_SESSION['current_question']) ? (int)$_SESSION['current_question'] : 0 ?>,
    tempo: <?= isset($_SESSION['tempo_segundos']) ? (int)$_SESSION['tempo_segundos'] : 0 ?>
};
const jaEnviado = <?= $_SESSION['enviado_ao_servidor'] ? 'true':'false' ?>;

document.addEventListener('DOMContentLoaded', () => {

    const perguntaEl = document.getElementById('pergunta');
    if (!perguntaEl) {
        return; 
    }

    
    const botoesResposta = [
        document.getElementById('resposta1'),
        document.getElementById('resposta2'),
        document.getElementById('resposta3'),
        document.getElementById('resposta4')
    ];
    const coracaoDiv = document.getElementById('coracao');

    let indiceAtual = estadoInicial.indiceAtual;
    let vidas = estadoInicial.vidas;
    let pontuacao = estadoInicial.pontuacao;
    let tempo = estadoInicial.tempo;
    const tempoEl = document.getElementById('tempo');

    function atualizarTempoVisual() {
        if (tempoEl) tempoEl.textContent = `Tempo: ${tempo}s`;
    }

    atualizarTempoVisual();
    // Inicia contador de tempo
    let intervaloTempo = setInterval(() => {
        // Só conta se quiz não acabou
        if (indiceAtual < perguntas.length && vidas > 0) {
            tempo++;
            atualizarTempoVisual();
            // Salva a cada 10 segundos para persistir o tempo
            if (tempo % 10 === 0) salvarEstado();
        } else {
            clearInterval(intervaloTempo);
        }
    }, 1000);

    function salvarEstado() {
        fetch('salvar_estado.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ vidas, pontuacao, indiceAtual, tempo })
        }).catch(() => {});
    }

    function carregarProximaPergunta() {
        if (indiceAtual >= perguntas.length) {
            finalizarQuiz(true);
            return;
        }
        const p = perguntas[indiceAtual];
        perguntaEl.innerText = p.texto;

        botoesResposta.forEach((botao, index) => {
            if (botao) {
                botao.innerText = p.respostas[index];
                botao.className = '';
                botao.disabled = false;
            }
        });
    }

    function verificarResposta(indiceResposta) {
        botoesResposta.forEach(botao => { if(botao) botao.disabled = true; });

        const p = perguntas[indiceAtual];
        const respostaEscolhida = p.respostas[indiceResposta];
        const botaoEscolhido = botoesResposta[indiceResposta];

        if (respostaEscolhida === p.correta) {
            botaoEscolhido.classList.add('correta');
            pontuacao++;
        } else {
            botaoEscolhido.classList.add('errada');
            vidas--;
            atualizarVidas();
            const indiceCorreto = p.respostas.findIndex(r => r === p.correta);
            if (indiceCorreto !== -1 && botoesResposta[indiceCorreto]) {
                botoesResposta[indiceCorreto].classList.add('correta');
            }
        }

        salvarEstado();
        setTimeout(() => {
            if (vidas <= 0) {
                finalizarQuiz(false);
            } else if (indiceAtual >= perguntas.length - 1) {
                finalizarQuiz(true); 
            } else {
                indiceAtual++;
                salvarEstado();
                carregarProximaPergunta();
            }
        }, 1200);
    }

    function atualizarVidas() {
        let coracoesHtml = '';
        for (let i = 0; i < 3; i++) {
            coracoesHtml += (i < vidas) ? '❤️ ' : '🖤 ';
        }
        if (coracaoDiv) {
            coracaoDiv.innerHTML = coracoesHtml;
        }
    }

    function finalizarQuiz(venceu) {
        const containerRespostas = document.getElementById('respostas');
    if (venceu) {
        document.getElementById('tela-vitoria').style.display = 'flex';
        if (!jaEnviado) {
            // Redireciona apenas primeira vez para salvar no servidor
            window.location = 'salvar_dados.php';
        }
    } else {
        document.getElementById('tela-derrota').style.display = 'flex';
        if (!jaEnviado) {
            window.location = 'salvar_dados.php';
        }
    }
        if (containerRespostas) {
            containerRespostas.innerHTML = '<button onclick="window.location.reload()" style="cursor: pointer;">Jogar Novamente</button>';
        }
    // Marca como concluído para que ao recarregar já mostre a tela final
    indiceAtual = perguntas.length;
    salvarEstado();
    clearInterval(intervaloTempo);
    }


    botoesResposta.forEach((botao, index) => {
        if (botao) {
            botao.addEventListener('click', () => {
                verificarResposta(index);
            });
        }
    });

    if (perguntas && perguntas.length > 0) {
        atualizarVidas();
        if (indiceAtual >= perguntas.length) {
            // Decide se foi derrota ou vitória com base nas vidas restantes
            if (vidas <= 0) {
                finalizarQuiz(false);
            } else {
                finalizarQuiz(true);
            }
        } else {
            carregarProximaPergunta();
        }
    } else {
        perguntaEl.innerText = "Erro: Nenhuma pergunta foi carregada do servidor.";
    }
});
</script>


</body>

</html>