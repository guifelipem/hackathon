<?php
session_start();
require_once __DIR__ . '/../classes/Login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $data = json_encode(['email' => $email, 'senha' => $senha]);
    $ch = curl_init('http://localhost:3333/login');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (Login::salvarSessaoLogin($result)) {
    header('Location: eventos.php');
    exit();
    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../css/Login.css">
    </head>
    <body id="login-body">
        
        <div id="topo-login">
            <h1 id="login-titulo">🎓 Login</h1>
        </div>

        <main>
            <div class="card-login" id="card-login">
                <form method="post" id="form-login">
                    <input type="email" name="email" id="input-email" required placeholder="📧 E-mail">
                    <input type="password" name="senha" id="input-senha" required placeholder="🔒 Senha">
                    <button type="submit" id="botao-entrar">Entrar</button>
                </form>

                <nav id="nav-login">
                    <ul id="menu-login">
                        <li><a href="registrar.php" id="link-registrar">Ainda não é cadastrado?</a></li>
                    </ul>
                </nav>

                <?php if (isset($erro)) echo "<p class='mensagem erro' id='erro-login'>$erro</p>"; ?>
            </div>
        </main>
    </body>

</html>