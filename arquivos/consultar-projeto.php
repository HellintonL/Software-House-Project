<?php

// Caminho do arquivo JSON
$caminhoJson = __DIR__ . "/../dados/projetos.json";

// Lê os projetos salvos
$conteudoJson = file_get_contents($caminhoJson);
$projetos = json_decode($conteudoJson, true);

if (!is_array($projetos)) {
    $projetos = [];
}

$projetosCliente = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST["email"] ?? ""));

    foreach ($projetos as $projeto) {
        if (
            isset($projeto["email"]) &&
            strtolower(trim($projeto["email"])) == $email
        ) {
            $projetosCliente[] = $projeto;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar status do projeto | APD</title>
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
                <p>Etapa 9 do processo</p>
                <h1>Consultar status do projeto</h1>
                <p>Informe seu e-mail para acompanhar o resultado da análise, orçamento e andamento atual do projeto.</p>
            </div>

            <form method="POST">
                <label for="email">Seu e-mail *</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Consultar</button>
            </form>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                <?php if (empty($projetosCliente)) { ?>
                    <p class="mensagem erro" role="status" style="margin-top: 25px;">Nenhum projeto encontrado para este e-mail.</p>
                <?php } else { ?>
                    <?php foreach ($projetosCliente as $projeto) { ?>
                        <div style="margin-top: 30px; border: 1px solid #dfe7ee; border-radius: 8px; padding: 20px; background: #f8fbfd;">
                            <h2 style="margin: 0 0 15px; color: #173746; font-size: 24px;">
                                <?= htmlspecialchars($projeto["nome_projeto"] ?? "Projeto") ?>
                            </h2>

                            <?php if (isset($projeto["resposta"])) { ?>
                                <?php if ($projeto["resposta"] == "REPROVAR") { ?>
                                    <p><strong>Resultado:</strong> Recusado.</p>
                                <?php } else { ?>
                                    <p><strong>Resultado:</strong> Aprovado!</p>
                                    <p>
                                        <strong>Orçamento:</strong>
                                        <?php if (isset($projeto["orcamento"])) { ?>
                                            R$ <?= number_format((float) $projeto["orcamento"], 2, ',', '.') ?>
                                        <?php } else { ?>
                                            Não informado
                                        <?php } ?>
                                    </p>
                                <?php } ?>
                            <?php } else { ?>
                                <p><strong>Status:</strong> Aguardando avaliação da equipe de T.I.</p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </section>
    </main>

    <footer>
        <p>Desenvolvido pelo Grupo APD</p>
        <p>HTML + CSS + PHP + JSON</p>
    </footer>
</body>

</html>