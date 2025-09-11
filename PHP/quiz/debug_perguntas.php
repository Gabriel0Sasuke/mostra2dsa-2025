<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
$perguntas = $_SESSION['perguntas_quiz'] ?? null;
// Normaliza para UTF-8 caso host esteja retornando ISO-8859-1
if ($perguntas) {
    foreach ($perguntas as &$pp) {
        if (isset($pp['texto'])) $pp['texto'] = mb_convert_encoding($pp['texto'], 'UTF-8', 'UTF-8, ISO-8859-1');
        if (isset($pp['correta'])) $pp['correta'] = mb_convert_encoding($pp['correta'], 'UTF-8', 'UTF-8, ISO-8859-1');
        if (isset($pp['respostas']) && is_array($pp['respostas'])) {
            foreach ($pp['respostas'] as &$r) {
                $r = mb_convert_encoding($r, 'UTF-8', 'UTF-8, ISO-8859-1');
            }
        }
    }
    unset($pp);
}
$nome = $_SESSION['nome'] ?? null;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Debug Perguntas (Sessão)</title>
    <style>
        body { font-family: Arial, sans-serif; background:#111; color:#eee; margin:20px; }
        h1 { margin-top:0; }
        .status { padding:10px; background:#222; border:1px solid #333; margin-bottom:15px; }
        table { border-collapse: collapse; width:100%; margin-top:10px; }
        th, td { border:1px solid #444; padding:8px; vertical-align: top; }
        th { background:#222; }
        .correta { color:#4caf50; font-weight:bold; }
        .vazia { color:#ff9800; }
        pre { background:#1e1e1e; padding:10px; overflow:auto; border:1px solid #333; }
        a { color:#64b5f6; }
        .small { font-size:12px; opacity:.8; }
        .badge { display:inline-block; background:#333; padding:2px 6px; border-radius:4px; font-size:12px; margin-left:6px; }
    </style>
</head>
<body>
    <h1>Debug Perguntas em Sessão</h1>
    <div class="status">
        <p><strong>Nome na sessão:</strong> <?= $nome ? htmlspecialchars($nome) : '<span class="vazia">(não definido)</span>' ?></p>
        <p><strong>Quantidade de perguntas:</strong> <?= $perguntas ? count($perguntas) : 0 ?></p>
        <p><strong>Arquivo origem:</strong> quiz.php armazena em $_SESSION['perguntas_quiz'] na primeira carga após definir o nome.</p>
        <p class="small">Se estiver 0:
            <br>- Verifique se você acessou <code>quiz.php</code> depois de enviar o nome.
            <br>- Confirme se o cookie de sessão está sendo mantido.
            <br>- Veja se houve erro silencioso no servidor (error_log).</p>
        <p><a href="quiz.php">Voltar ao Quiz</a></p>
    </div>

<?php if (!$perguntas): ?>
    <p><em>Nenhuma pergunta armazenada na sessão.</em></p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Pergunta</th>
                <th>Respostas (marcando a correta)</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($perguntas as $i => $p): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= htmlspecialchars($p['texto']) ?></td>
                <td>
                    <ol style="margin:0; padding-left:18px;">
                        <?php foreach ($p['respostas'] as $resp): ?>
                            <?php $ok = ($resp === $p['correta']); ?>
                            <li class="<?= $ok ? 'correta' : '' ?>">
                                <?= htmlspecialchars($resp) ?>
                                <?php if ($ok): ?><span class="badge">correta</span><?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Dump JSON</h2>
    <?php
        $json = json_encode($perguntas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            echo '<pre>Erro ao gerar JSON: '. json_last_error_msg() ."\n".print_r($perguntas, true).'</pre>';
        } else {
            echo '<pre>'.htmlspecialchars($json).'</pre>';
        }
    ?>
<?php endif; ?>

    <hr>
    <p class="small">Remova este arquivo em produção. Uso apenas para diagnóstico.</p>
</body>
</html>