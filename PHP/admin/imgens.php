<?php
session_start();
require_once __DIR__ . '/../../include/conn.php';

// Sanitiza/recebe campos
$grupo   = trim($_POST['grupo'] ?? '');
$legenda = trim($_POST['legenda'] ?? '');
$autor   = $_SESSION['nomeadmin'] ?? 'Desconhecido';

// Verifica se veio arquivo e trata códigos de erro específicos
if (!isset($_FILES['imagem'])) {
    http_response_code(400);
    echo "Campo de arquivo 'imagem' não recebido. Verifique se o formulário tem enctype='multipart/form-data'.";
    exit;
}

if ($_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
    $erro = $_FILES['imagem']['error'];
    $mapaErros = [
        UPLOAD_ERR_INI_SIZE   => 'Arquivo excede o limite definido em upload_max_filesize no php.ini.',
        UPLOAD_ERR_FORM_SIZE  => 'Arquivo excede o limite permitido pelo formulário.',
        UPLOAD_ERR_PARTIAL    => 'Upload não concluído (recebido parcialmente).',
        UPLOAD_ERR_NO_FILE    => 'Nenhum arquivo foi selecionado.',
        UPLOAD_ERR_NO_TMP_DIR => 'Pasta temporária ausente no servidor.',
        UPLOAD_ERR_CANT_WRITE => 'Falha ao gravar o arquivo em disco.',
        UPLOAD_ERR_EXTENSION  => 'Upload interrompido por extensão PHP.'
    ];
    $msg = $mapaErros[$erro] ?? ('Erro desconhecido (código '.$erro.').');
    http_response_code(400);
    echo 'Falha no upload: ' . $msg;
    exit;
}

// Configurações de upload
$dirPublicoRelativo = 'images/makeoff'; // relativo à raiz pública
$dirFisico = realpath(__DIR__ . '/../../'); // raiz do projeto (onde está index.php presumidamente)
if ($dirFisico === false) {
    die('Falha ao resolver caminho base.');
}
$destino = $dirFisico . DIRECTORY_SEPARATOR . $dirPublicoRelativo;

// Cria diretório se não existir
if (!is_dir($destino)) {
    if (!mkdir($destino, 0755, true)) {
        http_response_code(500);
        echo "Não foi possível criar a pasta de destino.";
        exit; 
    }
}

// Limites e validação
$tamanhoMax = 5 * 1024 * 1024; // 5MB
if ($_FILES['imagem']['size'] > $tamanhoMax) {
    http_response_code(413);
    echo "Arquivo excede 5MB.";
    exit; 
}

// Verifica MIME real
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $_FILES['imagem']['tmp_name']);
finfo_close($finfo);

if (strpos($mime, 'image/') !== 0) {
    http_response_code(415);
    echo "Arquivo enviado não é uma imagem válida.";
    exit; 
}

// Determina extensão a partir do MIME (fallback para original)
$extMapa = [
    'image/jpeg' => 'jpg',
    'image/pjpeg' => 'jpg',
    'image/png' => 'png',
    'image/gif' => 'gif',
    'image/webp' => 'webp',
    'image/avif' => 'avif',
    'image/bmp' => 'bmp',
    'image/x-ms-bmp' => 'bmp',
    'image/svg+xml' => 'svg',
    'image/tiff' => 'tiff',
    'image/x-icon' => 'ico'
];

$ext = $extMapa[$mime] ?? pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
$ext = strtolower(preg_replace('/[^a-z0-9]+/i','', $ext));
if ($ext === '') { $ext = 'img'; }

// Gera nome único padronizado: makeoff_<codigo>
try {
    $codigo = bin2hex(random_bytes(5)); // 10 caracteres hex
} catch (Exception $e) {
    $codigo = uniqid(); // fallback
}
$nomeArquivoFinal = 'makeoff_' . $codigo . '.' . $ext;

$caminhoFisicoFinal = $destino . DIRECTORY_SEPARATOR . $nomeArquivoFinal;
$caminhoPublicoFinal = $dirPublicoRelativo . '/' . $nomeArquivoFinal; // para salvar no banco

// Move arquivo
if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoFisicoFinal)) {
    http_response_code(500);
    echo "Erro ao salvar a imagem.";
    exit; 
}

// Inserir registro no banco (tabela makeoff)
$sqlInsert = "INSERT INTO makeoff (nome_arquivo, caminho_arquivo, grupo, legenda, autor) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
if (!$stmt) {
    http_response_code(500);
    echo "Erro prepare: " . $conn->error;
    exit; 
}
$stmt->bind_param('sssss', $nomeArquivoFinal, $caminhoPublicoFinal, $grupo, $legenda, $autor);
if (!$stmt->execute()) {
    http_response_code(500);
    echo "Erro ao gravar no banco: " . $stmt->error;
    // Opcional: remover arquivo físico se falhar banco
    @unlink($caminhoFisicoFinal);
    exit; 
}
$stmt->close();

// Sucesso: redireciona de volta para painel admin
$conn->close();
header('Location: admin.php?upload=ok');
exit; 
?>
