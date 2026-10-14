
<?php

// Caminho do arquivo JSON
$caminhoJson = dirname(__DIR__) . "/dados/projetos.json";

// Verifica se a equipe enviou uma resposta
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lê os projetos salvos
    $conteudoJson = file_get_contents($caminhoJson);
    $projetos = json_decode($conteudoJson, true);

    // Identifica o projeto e recebe a resposta
    $indice = (int) $_POST["indice"];
    $resposta = $_POST["resposta"];
    $orcamento = $_POST["orcamento"];

    // Verifica se o projeto existe e se a resposta é válida
    if (
        isset($projetos[$indice]) &&
        ($resposta == "APROVAR" || $resposta == "REPROVAR")
    ) {

        // Salva a resposta e atualiza o status
        $projetos[$indice]["resposta"] = $resposta;
        $projetos[$indice]["status"] = "Respondido";
        $projetos[$indice]["orcamento"] = $orcamento;

        // Atualiza o arquivo JSON
        $jsonAtualizado = json_encode(
            $projetos,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

        file_put_contents($caminhoJson, $jsonAtualizado);
    }

    // Volta para a aba de projetos respondidos
    header("Location: equipe-ti.php?aba=respondidos");
    exit;
}

// Lê novamente os projetos para exibi-los na página
$conteudoJson = file_get_contents($caminhoJson);
$projetos = json_decode($conteudoJson, true);

// Define qual aba será exibida
$aba = isset($_GET["aba"]) ? $_GET["aba"] : "aguardando";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área da equipe de T.I.</title>

    <style>
        nav {
            margin-bottom: 25px;
        }

        nav a {
            margin-right: 15px;
        }

        .aba {
            display: inline-block;
            padding: 10px;
            background-color: #ddd;
            color: black;
            text-decoration: none;
        }

        .ativa {
            background-color: #333;
            color: white;
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

    <h1>Projetos recebidos</h1>

    <!-- Abas para organizar os projetos -->
    <div>
        <a class="aba <?= $aba == 'aguardando' ? 'ativa' : '' ?>"
           href="equipe-ti.php?aba=aguardando">
            Aguardando avaliação
        </a>

        <a class="aba <?= $aba == 'respondidos' ? 'ativa' : '' ?>"
           href="equipe-ti.php?aba=respondidos">
            Projetos respondidos
        </a>
    </div>

    <hr>

    <?php

    // Controla se algum projeto foi encontrado na aba
    $encontrou = false;

    // Percorre todos os projetos cadastrados
    foreach ($projetos as $indice => $projeto) {

        // Verifica se o projeto já recebeu uma resposta
        $temResposta = isset($projeto["resposta"]);

        // Mostra apenas os projetos da aba selecionada
        if (
            ($aba == "respondidos" && $temResposta) ||
            ($aba != "respondidos" && !$temResposta)
        ) {

            $encontrou = true;
    ?>

            <h2>
                <?= htmlspecialchars($projeto["nome_projeto"]) ?>
            </h2>

            <p>
                <strong>Cliente:</strong>
                <?= htmlspecialchars($projeto["nome"]) ?>
            </p>

            <p>
                <strong>E-mail:</strong>
                <?= htmlspecialchars($projeto["email"]) ?>
            </p>

            <p>
                <strong>Descrição:</strong>
                <?= nl2br(htmlspecialchars($projeto["descricao"])) ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?= htmlspecialchars($projeto["status"]) ?>
            </p>

            <?php if ($temResposta) { ?>

                <!-- Mostra a resposta já enviada -->
                <p>
                    <strong>Resposta da equipe:</strong>
                    <?= htmlspecialchars($projeto["resposta"]) ?>
                </p>

                <p>
                    <strong>Orçamento:</strong>
                    R$ 
                    <?= isset($projeto["orcamento"])

                        // converte o valor para número decimal
                        ? number_format((float)$projeto["orcamento"],   // printa valor do orçamento
                        2,   // define o número de casas decimais
                        ',', // define o separador decimal
                        '.'  // define o separador de milhar
                        )

                        // caso não tenha orçamento, exibe a mensagem
                        : "Não informado" ?>
                </p>

            <?php } else { ?>

                <!-- Formulário para responder ao projeto -->
                <form method="POST">

                    <!-- Identifica qual projeto receberá a resposta -->
                    <input type="hidden" name="indice"
                           value="<?= $indice ?>">

                    <label>Resposta final:</label>

                    <select name="resposta">
                        <option value="APROVAR">APROVAR</option>
                        <option value="REPROVAR">REPROVAR</option>
                    </select>

                    <br><br>

                    <label>Orçamento do projeto (R$):</label>
                    <input type="number" name="orcamento" min="0" step="0.01" required>

                    <button type="submit">Enviar resposta</button>

                </form>

            <?php } ?>

            <hr>

    <?php
        }
    }

    // Mostra uma mensagem caso a aba esteja vazia
    if (!$encontrou) {
    ?>

        <p>Nenhum projeto nesta aba.</p>

    <?php } ?>

</body>
</html>
