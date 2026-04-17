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
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f8e1e7, #eec9d2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            background: #fff7f9;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(180, 120, 140, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #8b5e6c;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #7a4f5d;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #e4b7c2;
            border-radius: 8px;
            transition: 0.3s;
            background: #fff;
        }

        input:focus {
            border-color: #d291a3;
            outline: none;
            box-shadow: 0 0 5px rgba(210, 145, 163, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background: #d291a3;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #c27b8f;
        }

        .mensagem {
            margin-top: 15px;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .erro {
            background: #ffe6eb;
            color: #a9445b;
        }

        .sucesso {
            background: #e6fff0;
            color: #5a8f6a;
        }

        .dados {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🌸 Cadastro</h1>

        <form method="POST">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>

            <label>E-mail</label>
            <input type="email" name="email" value="<?= $email ?>" required>

            <label>Telefone</label>
            <input type="text" name="telefone" value="<?= $telefone ?>" required>

            <button type="submit">Enviar</button>
        </form>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem <?= $mensagem === "Dados recebidos com sucesso!" ? 'sucesso' : 'erro' ?>">
                <?= $mensagem ?>
            </div>

            <?php if ($mensagem === "Dados recebidos com sucesso!"): ?>
                <div class="dados">
                    <p><strong>Nome:</strong> <?= $nome ?></p>
                    <p><strong>E-mail:</strong> <?= $email ?></p>
                    <p><strong>Telefone:</strong> <?= $telefone ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
