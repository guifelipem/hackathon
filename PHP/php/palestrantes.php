<?php
require_once __DIR__ . '/protect.php';

$url = 'http://localhost:3333/palestrantes';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $_SESSION['token']
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$palestrantes = [];
$erro = '';

if ($httpCode === 200) {
    $palestrantes = json_decode($response, true);
} else {
    $erro = "Erro ao carregar palestrantes (HTTP $httpCode)";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Palestrantes</title>
    <link rel="stylesheet" href="../css/palestrantes.css">
</head>
<body id="pagina-palestrantes">

    <?php include 'includes/header.php'?>
    <h1 id="titulo-palestrantes">🎤 Palestrantes</h1>

    <main>    
        <?php if (!empty($erro)): ?>
            <p id="mensagem-erro"><?= htmlspecialchars($erro) ?></p>
        <?php elseif (empty($palestrantes)): ?>
            <p id="mensagem-vazia">Nenhum palestrante encontrado.</p>
        <?php else: ?>
            <div id="container-palestrantes">
                <?php foreach ($palestrantes as $palestrante): ?>
                    <div class="card">
                        <img src="<?= htmlspecialchars($palestrante['foto_url'] ?? 'https://via.placeholder.com/100') ?>" alt="Foto de <?= htmlspecialchars($palestrante['nome'] ?? 'Palestrante') ?>">
                        <h2><?= htmlspecialchars($palestrante['nome'] ?? '-') ?></h2>
                        <h3><?= htmlspecialchars($palestrante['tema'] ?? '-') ?></h3>
                        <p><?= htmlspecialchars($palestrante['minicurriculo'] ?? '-') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
