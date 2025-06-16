<?php
include 'protect.php';

$ch = curl_init('http://localhost:3333/inscricoes');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $_SESSION['token'],
    'Content-Type: application/json'
]);
$response = curl_exec($ch);
curl_close($ch);
$inscricoes = json_decode($response, true);


if (isset($_GET['id'])) {
    $inscricaoId = $_GET['id'];
    $token = $_SESSION['token'];

    $ch = curl_init("http://localhost:3333/inscricoes/$inscricaoId");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $resultado = json_decode($response, true);

    if ($httpcode === 200) {
        echo "<script>alert('Inscrição removida com sucesso!'); window.location.href='meus_eventos.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao remover inscrição: " . ($resultado['error'] ?? 'Erro desconhecido') . "');</script>";
    }
}

if (isset($_GET['evento_id'])) {
    $eventoId = $_GET['evento_id'];
    $token = $_SESSION['token'];

    $url = "http://localhost:3333/inscricoes/{$eventoId}/certificado";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $resultado = json_decode($response, true);

    if ($httpcode === 200 && isset($resultado['path'])) {
        $_SESSION['certificado_link'] = "http://localhost:3333/" . $resultado['path'];
        header("Location: meus_eventos.php#modal");
        exit;
    } else {
        echo "<script>alert('Erro ao gerar certificado: " . ($resultado['error'] ?? 'Erro desconhecido') . "');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Eventos</title>
    <link rel="stylesheet" href="../css/meus_eventos.css">
</head>
<body id="corpo">
<?php include 'includes/header.php'; ?>

<main id="main-inscricoes">
    <h1 id="titulo-inscricoes">🎓 Meus Eventos Inscritos</h1>
    <div id="modal" class="modal-overlay">
    <div class="modal-box">
        <h2>🎉 Certificado Gerado!</h2>
        <p>O certificado foi emitido com sucesso.</p>
        <?php if (isset($_SESSION['certificado_link'])): ?>
            <a href="<?= $_SESSION['certificado_link'] ?>" target="_blank" class="btn-modal">📄 Abrir Certificado</a>
            <?php unset($_SESSION['certificado_link']); ?>
        <?php endif; ?>
        <a href="meus_eventos.php" class="btn-fechar">Fechar</a>
    </div>
</div>



    <?php
    foreach ($inscricoes as $inscricao) {
        $eventoNome = $inscricao['evento'] ?? 'Evento desconhecido';
        $data = date("d/m/Y", strtotime($inscricao['data'] ?? ''));
        $inscricaoId = $inscricao['id'] ?? 0;
        $eventoId = $inscricao['evento_id'] ?? 0;

        echo "
        <div class='card-inscricao' id='inscricao-{$inscricaoId}'>
            <div class='evento-nome'>$eventoNome</div>
            <div class='evento-data'>📅 $data</div>
            <div class='botoes-inscricao'>
                <form method='GET'>
                    <input type='hidden' name='evento_id' value='{$eventoId}'>
                    <button type='submit' class='btn-certificado'>🎓 Gerar Certificado</button>
                </form>
                <form method='GET'>
                    <input type='hidden' name='id' value='{$inscricaoId}'>
                    <button type='submit' class='btn-remover'>🗑 Remover Inscrição</button>
                </form>
            </div>
        </div>";
    }
?>
</main>

</body>
</html>