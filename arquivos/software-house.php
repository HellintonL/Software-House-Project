<?php

// Verifica se o usuário já enviou o formulário

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $nome_projeto = $_POST["nome_projeto"];
    $descricao = $_POST["descricao"];

    $novoProjeto = [
        "nome" => $nome,
        "email" => $email,
        "nome_projeto" => $nome_projeto,
        "descricao" => $descricao,
        "status" => "Aguardando avaliação"
    ];

    // Lê os projetos que já estão salvos no arquivo JSON
    $conteudoJson = file_get_contents(
       dirname(__DIR__) . "/dados/projetos.json"
    );

    // Transforma o conteúdo JSON em um array PHP
    $projetos = json_decode($conteudoJson, true);

    // Adiciona o novo projeto ao array
    $projetos[] = $novoProjeto;

    // Transforma o array PHP novamente em JSON
    $jsonAtualizado = json_encode(
        $projetos,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    // Salva os projetos atualizados no arquivo JSON
    file_put_contents(
        dirname(__DIR__) . "/dados/projetos.json",
        $jsonAtualizado
    );

    // Exibe uma mensagem de confirmação
    $mensagem = "Projeto enviado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/enviar-projeto.css">
    <title>Enviar Projeto</title>

    <!-- --------- CSS ------------ -->

    <style>

        <!-- VISUAL DA BARRA DE NAVEGAÇÃO-->
        nav {
            background-color: #222;
            padding: 15px;
        }

        nav a {
            color: #10006d;
            text-decoration: none;
            margin-right: 20px;
        }

        nav a:hover {
            color: #1d00c4;
        }
    </style>

</head>

<body>

        <!-- Barra de navegação -->
    <nav>
        <a href="software-house.php">Enviar projeto</a>
        <a href="equipe-ti.php">Área da equipe de T.I.</a>
        <a href="consultar-projeto.php">Consultar projeto</a>
        <a href="../index.php">VOLTAR ÍNDEX</a>
    </nav>

    <h1>Envie sua ideia de projeto</h1>

    <p>
        Conte sua ideia de projeto para nós! Preencha o formulário abaixo 
        com as informações necessárias e nossa equipe irá avaliar sua proposta.
    </p>

    <!-- Formulário para receber a ideia do cliente -->
    <form method="POST">

        <label>Seu nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label>Seu e-mail:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Nome do projeto:</label>
        <input type="text" name="nome_projeto" required>
        <br><br>

        <label>Descreva sua ideia:</label>
        <br>
        <textarea name="descricao" rows="6" required></textarea>
        <br><br>

        <button type="submit">Enviar</button>

    </form>

    <!-- Mensagem de envio -->
    <?php if (isset($mensagem)) { ?>
        <p><?= $mensagem ?></p>
    <?php } ?>

</body>

</html>