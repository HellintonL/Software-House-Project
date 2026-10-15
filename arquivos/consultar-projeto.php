
<?php

// Caminho do arquivo JSON
$caminhoJson = __DIR__ . "/dados/projetos.json";

// Lê os projetos salvos
$conteudoJson = file_get_contents($caminhoJson);

// Transforma o JSON em um array PHP
$projetos = json_decode($conteudoJson, true);

// Guarda os projetos encontrados para o cliente
$projetosCliente = [];

// Verifica se o cliente enviou o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe o e-mail informado pelo cliente
    $email = strtolower(trim($_POST["email"]));

    // Procura projetos que possuem esse e-mail
    foreach ($projetos as $projeto) {

        if (
            isset($projeto["email"]) &&
            strtolower(trim($projeto["email"])) == $email
        ) {

            // Adiciona o projeto encontrado à lista
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
    <link rel="stylesheet" href="../style/consultar.css">
    <title>Consultar Projeto</title>
    
</head>

<body>

    <!-- Barra de navegação -->
    <nav>
        <a href="software-house.php">Enviar projeto</a>
        <a href="equipe-ti.php">Área da equipe de T.I.</a>
        <a href="consultar-projeto.php">Consultar projeto</a>
        <a href="../index.php">VOLTAR ÍNDEX</a>
    </nav>

    <h1>Consulte seu projeto</h1>

    <p>Informe seu e-mail para consultar o resultado da avaliação.</p>

    <!-- Formulário para localizar os projetos do cliente -->
    <form method="POST">

        <label>Seu e-mail:</label>
        <input type="email" name="email" required>

        <button type="submit">Consultar</button>

    </form>

    <hr>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

        <!-- Verifica se algum projeto foi encontrado -->
        <?php if (empty($projetosCliente)) { ?>

            <p>Nenhum projeto encontrado para este e-mail.</p>

        <?php } else { ?>

            <!-- Exibe os projetos encontrados -->
            <?php foreach ($projetosCliente as $projeto) { ?>

                <h2>
                    <?= htmlspecialchars($projeto["nome_projeto"]) ?>
                </h2>

                <!-- Verifica se a equipe já respondeu -->
                <?php if (isset($projeto["resposta"])) { ?>

                    <!-- Se foi recusado, não mostra orçamento -->
                    <?php if ($projeto["resposta"] == "REPROVAR") { ?>

                        <p><strong>Resultado:</strong> Recusado.</p>

                    <?php } else { ?>

                        <!-- Se foi aprovado, mostra o resultado e o orçamento -->
                        <p><strong>Resultado:</strong> Aprovado!</p>

                        <p>
                            <strong>Orçamento:</strong>

                            <?php if (isset($projeto["orcamento"])) { ?>

                                R$ <?= number_format(
                                    (float)$projeto["orcamento"],
                                    2,
                                    ',',
                                    '.'
                                ) ?>

                            <?php } else { ?>

                                Não informado

                            <?php } ?>
                        </p>

                    <?php } ?>

                <?php } else { ?>

                    <!-- Projeto que ainda não recebeu resposta -->
                    <p>
                        <strong>Status:</strong>
                        Aguardando avaliação da equipe de T.I.
                    </p>

                <?php } ?>

                <hr>

            <?php } ?>

        <?php } ?>

    <?php } ?>

</body>

</html>