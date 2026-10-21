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
    <title>Solicitação de projeto</title>

    <!-- --------- CSS ------------ -->

    <style>
        <!-- VISUAL DA BARRA DE NAVEGAÇÃO-->
        nav
        {
        background-color:
        #222;
        padding:
        15px;
        }
        nav
        a
        {
        color:
        #10006d;
        text-decoration:
        none;
        margin-right:
        20px;
        }
        nav
        a:hover
        {
        color:
        #1d00c4;
        }
    </style>

</head>

<body>

    <!-- Barra de navegação -->
    <nav>
        <a href="../index.php">Início</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="software-house.php">Solicitar projeto</a>
        <a href="orcamento.php">Orçamento</a>
        <a href="consultar-projeto.php">Consultar projeto</a>
    </nav>

    <h1>Etapa 2 do processo</h1>

    <p>
        <br><br>
    <h2>Envie sua ideia de projeto</h2>
    
    Preencha o formulário abaixo com as informações da demanda e nossa equipe irá avaliar sua proposta.
    <br>
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
        <textarea name="descricao" rows="12" cols="55" required></textarea>
        <br><br>

        <button type="submit">Enviar solicitação</button>

    </form>

    <!-- Mensagem de envio -->
    <?php if (isset($mensagem)) { ?>
        <p><?= $mensagem ?></p>
    <?php } ?>

</body>

</html>