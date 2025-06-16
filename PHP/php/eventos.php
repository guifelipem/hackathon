<?php
require_once __DIR__ . '/protect.php';

if (!isset($_SESSION['token']) || !isset($_SESSION['aluno'])) {
    header('Location: login.php');
    exit();
}

$token = $_SESSION['token'];
$aluno = $_SESSION['aluno'];

$ch = curl_init("http://localhost:3333/eventos");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$eventos = [];
$erro = '';

if ($httpCode === 200) {
    $eventos = json_decode($response, true);
} else {
    $erro = "Não foi possível carregar os eventos. Código HTTP: $httpCode";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/Eventos.css">
<head>
    
    <title>Eventos</title>
    
</head>
<body id="corpo">
    <?php include 'includes/header.php' ?>
    <h1 id="titulo-eventos">🎫 Eventos Disponíveis</h1>

    <?php if (!empty($erro)): ?>
        <p id="mensagem-erro"><?= htmlspecialchars($erro) ?></p>
    <?php elseif (empty($eventos)): ?>
        <p id="mensagem-vazia">Nenhum evento disponível no momento.</p>
    <?php else: ?>
        
        <table id="tabela-eventos">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Palestrante</th>
                    <th>Tema</th>
                    <th>Coordenador</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
    
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= htmlspecialchars($evento['nome']) ?></td>
                        <td><?= htmlspecialchars($evento['descricao']) ?></td>
                        <td>
                            <?php
                                $dataISO = $evento['data'];
                                $dataFormatada = (new DateTime($dataISO))->format('d/m/Y');
                                echo htmlspecialchars($dataFormatada);
                            ?>
                        </td>
                        <td><?= htmlspecialchars($evento['horario_inicio']) ?></td>
                        <td><?= htmlspecialchars($evento['horario_fim']) ?></td>
                        <td><?= htmlspecialchars($evento['palestrante_nome']) ?></td>
                        <td><?= htmlspecialchars($evento['palestrante_tema']) ?></td>
                        <td><?= htmlspecialchars($evento['coordenador_nome']) ?></td>
                        <td>
                            <form method="post" action="inscrever.php">
                                <input type="hidden" name="evento_id" value="<?= htmlspecialchars($evento['id']) ?>">
                                <button type="submit">Inscrever-se</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
