<?php
// Inicialização das variáveis
$nome = "";
$email = "";
$telefone = "";
$mensagem = "";

// Função para sanitizar entradas
function limparEntrada($valor) {
    return htmlspecialchars(trim($valor));
}

// Verifica se houve envio via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = limparEntrada($_POST["nome"] ?? "");
    $email = limparEntrada($_POST["email"] ?? "");
    $telefone = limparEntrada($_POST["telefone"] ?? "");

    // Validação simples
    if (empty($nome) || empty($email) || empty($telefone)) {
        $mensagem = "Por favor, preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "E-mail inválido.";
    } else {
        $mensagem = "Dados recebidos com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Web II</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        .mensagem { margin-top: 15px; font-weight: bold; color: darkblue; }
    </style>
</head>
<body>
    <h1>Sistema Web II</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= $nome ?>" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= $email ?>" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?= $telefone ?>" required>

        <button type="submit">Enviar</button>
    </form>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?= $mensagem ?></div>
        <?php if ($mensagem === "Dados recebidos com sucesso!"): ?>
            <p><strong>Nome:</strong> <?= $nome ?></p>
            <p><strong>E-mail:</strong> <?= $email ?></p>
            <p><strong>Telefone:</strong> <?= $telefone ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
