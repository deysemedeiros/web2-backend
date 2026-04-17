<?php
$nome = "";
$email = "";
$telefone = "";
$mensagem = "";

function limparEntrada($valor) {
    return htmlspecialchars(trim($valor));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = limparEntrada($_POST["nome"] ?? "");
    $email = limparEntrada($_POST["email"] ?? "");
    $telefone = limparEntrada($_POST["telefone"] ?? "");

    if (empty($nome) || empty($email) || empty($telefone)) {
        $mensagem = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "E-mail inválido.";
    } else {
        $mensagem = "Sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    /* fundo estilo app */
    background: linear-gradient(135deg, #6a11cb, #2575fc);
}

/* card */
.card {
    background: #fff;
    padding: 30px;
    width: 100%;
    max-width: 350px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    text-align: center;
}

/* icone topo */
.icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #ff7eb3, #ff758c);
    border-radius: 50%;
    margin: -60px auto 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
}

/* titulo */
h2 {
    margin-bottom: 20px;
    color: #555;
}

/* inputs */
input {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border-radius: 20px;
    border: none;
    background: #f2f2f2;
    outline: none;
    transition: 0.3s;
}

input:focus {
    background: #e6e6e6;
}

/* botão */
button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: none;
    border-radius: 25px;
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
    color: white;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    opacity: 0.9;
}

/* mensagem */
.msg {
    margin-top: 10px;
    font-size: 14px;
    color: #444;
}
</style>
</head>

<body>

<div class="card">
    <div class="icon">🔒</div>

    <h2>Conecte-se agora</h2>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" value="<?= $nome ?>">
        <input type="email" name="email" placeholder="E-mail" value="<?= $email ?>">
        <input type="text" name="telefone" placeholder="Telefone" value="<?= $telefone ?>">

        <button type="submit">ENTRAR</button>
    </form>

    <?php if (!empty($mensagem)): ?>
        <div class="msg"><?= $mensagem ?></div>
    <?php endif; ?>
</div>

</body>
</html>
