<?php
session_start();
require_once __DIR__ . '/../classes/Registrar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => $_POST['senha'],
        'curso' => $_POST['curso']
    ];

    $resultado = Registrar::cadastrar($dados);

    if (isset($resultado['id'])) {
        header('Location: login.php');
        exit();
    } else {
        $erro = 'Erro ao cadastrar';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../css/registrar.css">
</head>
<body id="body-cadastro">
    <div id="topo">
        <h1 id="titulo-cadastro">📝 Cadastrar</h1>
    </div>

    <div id="conteudo-cadastro">
        <nav id="nav-registrar">
            <form method="post" id="form-cadastro">
                <input id="input-nome" type="text" name="nome" required placeholder="Nome">
                <input id="input-email" type="email" name="email" required placeholder="Email">
                <input id="input-senha" type="password" name="senha" required placeholder="Senha">
                <input id="input-curso" type="text" name="curso" required placeholder="Curso">
                <button id="btn-cadastrar" type="submit">Cadastrar</button>
            </form>
            <div id="menu-cadastro">
                <a href="login.php">Já possui uma conta?</a>
            </div>
        </nav>
    </div>

    <?php if (isset($erro)) echo "<p id='erro-msg'>$erro</p>"; ?>
</body>

</html>
