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

    $conteudoJson = file_get_contents(
        dirname(__DIR__) . "/dados/projetos.json"
    );

    $projetos = json_decode($conteudoJson, true);

    $projetos[] = $novoProjeto;

    $jsonAtualizado = json_encode(
        $projetos,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    file_put_contents(
        dirname(__DIR__) . "/dados/projetos.json",
        $jsonAtualizado
    );

    $mensagem = "Projeto enviado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de projeto | APD</title>
    <link rel="stylesheet" href="../style/empresa.css">
    <link rel="stylesheet" href="../style/cadastro.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="../index.php">
                <img src="../imagens/cabecalho.png" alt="Logo da APD" width="245px" height="100px">
            </a>
        </div>

        <nav>
            <a href="../index.php">Início</a>
            <a href="cadastro.php">Cadastro</a>
            <a href="software-house.php">Solicitar projeto</a>
            <a href="equipe-ti.php">Análise interna</a>
            <a href="orcamento.php">Orçamento</a>
            <a href="contra-proposta.php">Contra proposta</a>
            <a href="contrato.php">Contrato</a>
            <a href="financeiro.php">Financeiro</a>
            <a href="desenvolvimento.php">Desenvolvimento</a>
            <a href="consultar-projeto.php">Consultar projeto</a>
        </nav>
    </header>

    <main>
        <section class="cadastro">
            <div class="titulo-secao">
                <p>Etapa 2 do processo</p>
                <h1>Solicitação do projeto</h1>
                <p>Preencha o formulário com as informações da demanda e nossa equipe irá avaliar a proposta.</p>
            </div>

            <?php if (isset($mensagem)) { ?>
                <p class="mensagem sucesso" role="status"><?= $mensagem ?></p>
            <?php } ?>

            <form method="POST">
                <label for="nome">Seu nome *</label>
                <input type="text" id="nome" name="nome" required>

                <label for="email">Seu e-mail *</label>
                <input type="email" id="email" name="email" required>

                <label for="nome_projeto">Nome do projeto *</label>
                <input type="text" id="nome_projeto" name="nome_projeto" required>

                <label for="descricao">Descreva sua ideia *</label>
                <textarea id="descricao" name="descricao" rows="12" required></textarea>

                <button type="submit">Enviar solicitação</button>

                <p class="aviso-cadastro">* Campos obrigatórios.</p>
            </form>
        </section>
    </main>

    <footer>
        <p>Desenvolvido pelo Grupo APD</p>
        <p>HTML + CSS + PHP + JSON</p>
    </footer>
</body>

</html>