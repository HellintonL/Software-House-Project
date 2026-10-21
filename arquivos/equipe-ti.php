<?php

// Caminho do arquivo JSON
$caminhoJson = dirname(__DIR__) . "/dados/projetos.json";

// Lê os projetos salvos
$conteudoJson = file_get_contents($caminhoJson);
$projetos = json_decode($conteudoJson, true);

// Verifica se o JSON contém uma lista válida
if (!is_array($projetos)) {
    $projetos = [];
}

// Verifica se algum formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Identifica a ação solicitada
    $acao = $_POST["acao"] ?? "";

    // Guarda a aba atual para voltar a ela
    $abaDestino = ($_POST["aba"] ?? "") == "respondidos"
        ? "respondidos"
        : "aguardando";

    // Exclui todos os projetos do arquivo JSON
    if ($acao == "limpar_todos") {

        file_put_contents($caminhoJson, "[]");

        header("Location: equipe-ti.php?aba=" . $abaDestino);
        exit;
    }

    // Exclui um projeto específico
    if ($acao == "excluir_um") {

        $indice = (int) $_POST["indice"];

        // Verifica se o projeto existe
        if (isset($projetos[$indice])) {

            // Remove o projeto da lista
            array_splice($projetos, $indice, 1);

            // Atualiza o arquivo JSON
            $jsonAtualizado = json_encode(
                $projetos,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );

            file_put_contents($caminhoJson, $jsonAtualizado);
        }

        header("Location: equipe-ti.php?aba=" . $abaDestino);
        exit;
    }

    // Processa a resposta da equipe de T.I.
    if ($acao == "responder") {

        $indice = (int) $_POST["indice"];
        $resposta = $_POST["resposta"] ?? "";

        // Verifica se o projeto existe e a resposta é válida
        if (
            isset($projetos[$indice]) &&
            ($resposta == "APROVAR" || $resposta == "REPROVAR")
        ) {

            // Se o projeto for aprovado, exige um orçamento válido
            if ($resposta == "APROVAR") {

                $orcamento = $_POST["orcamento"] ?? "";

                if (
                    $orcamento === "" ||
                    !is_numeric($orcamento) ||
                    (float) $orcamento < 0
                ) {
                    header(
                        "Location: equipe-ti.php?aba=aguardando&erro=orcamento"
                    );
                    exit;
                }

                // Salva o orçamento do projeto aprovado
                $projetos[$indice]["orcamento"] = (float) $orcamento;

            } else {

                // Se for recusado, remove qualquer orçamento existente
                unset($projetos[$indice]["orcamento"]);
            }

            // Salva a resposta e atualiza o status
            $projetos[$indice]["resposta"] = $resposta;
            $projetos[$indice]["status"] = "Respondido";

            // Atualiza o arquivo JSON
            $jsonAtualizado = json_encode(
                $projetos,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );

            file_put_contents($caminhoJson, $jsonAtualizado);
        }

        // Após responder, abre a aba de projetos respondidos
        header("Location: equipe-ti.php?aba=respondidos");
        exit;
    }
}

// Define qual aba será exibida
$aba = ($_GET["aba"] ?? "") == "respondidos"
    ? "respondidos"
    : "aguardando";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de análise interna</title>
    <link rel="stylesheet" href="../style/equipe-ti.css">

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

        .campo-orcamento {
            margin-top: 10px;
        }

        button {
            margin-top: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Barra de navegação principal -->
    <nav>
        <a href="../index.php">Início</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="software-house.php">Solicitar projeto</a>
        <a href="equipe-ti.php">Análise interna</a>
        <a href="orcamento.php">Orçamento</a>
        <a href="consultar-projeto.php">Consultar projeto</a>
    </nav>

    <h1>Etapa 3 do processo: análise interna da demanda</h1>

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

    <!-- Exibe um aviso se o orçamento estiver inválido -->
    <?php if (isset($_GET["erro"]) && $_GET["erro"] == "orcamento") { ?>
        <p>Informe um orçamento válido para aprovar o projeto.</p>
    <?php } ?>

    <!-- Botão para excluir todos os projetos -->
    <?php if (!empty($projetos)) { ?>

        <form method="POST"
              onsubmit="return confirm('Deseja excluir TODOS os projetos?');">

            <input type="hidden" name="acao" value="limpar_todos">
            <input type="hidden" name="aba" value="<?= $aba ?>">

            <button type="submit">Excluir todos os projetos</button>
        </form>

    <?php } ?>

    <?php

    // Controla se algum projeto foi encontrado na aba
    $encontrou = false;

    // Percorre todos os projetos salvos
    foreach ($projetos as $indice => $projeto) {

        // Verifica se o projeto já recebeu uma resposta
        $temResposta = isset($projeto["resposta"]);

        // Exibe somente os projetos da aba escolhida
        if (
            ($aba == "respondidos" && $temResposta) ||
            ($aba == "aguardando" && !$temResposta)
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

            <?php if ($temResposta) { ?>

                <!-- Se foi recusado, mostra apenas o resultado -->
                <?php if ($projeto["resposta"] == "REPROVAR") { ?>

                    <p><strong>Resultado:</strong> Recusado.</p>

                <?php } else { ?>

                    <!-- Para os aprovados, mostra o resultado e o orçamento -->
                    <p><strong>Resultado:</strong> Aprovado!</p>

                    <p>
                        <strong>Orçamento:</strong>
                        R$ <?= number_format(
                            (float)($projeto["orcamento"] ?? 0),
                            2,
                            ',',
                            '.'
                        ) ?>
                    </p>

                <?php } ?>

            <?php } else { ?>

                <!-- Formulário para avaliar o projeto -->
                <form method="POST" class="form-resposta">

                    <input type="hidden" name="acao" value="responder">
                    <input type="hidden" name="indice"
                           value="<?= $indice ?>">
                    <input type="hidden" name="aba" value="<?= $aba ?>">

                    <label>Resposta final:</label>

                    <select name="resposta">
                        <option value="APROVAR">APROVAR</option>
                        <option value="REPROVAR">REPROVAR</option>
                    </select>

                    <!-- Campo que desaparece ao selecionar REPROVAR -->
                    <div class="campo-orcamento">
                        <label>Orçamento do projeto (R$):</label>

                        <input type="number"
                               name="orcamento"
                               min="0"
                               step="0.01"
                               required>
                    </div>

                    <br>

                    <button type="submit">Enviar resposta</button>

                </form>

                <p>
                    <strong>Status:</strong>
                    Aguardando avaliação
                </p>

            <?php } ?>

            <!-- Botão para excluir somente este projeto -->
            <form method="POST"
                  onsubmit="return confirm('Deseja excluir este projeto?');">

                <input type="hidden" name="acao" value="excluir_um">
                <input type="hidden" name="indice"
                       value="<?= $indice ?>">
                <input type="hidden" name="aba" value="<?= $aba ?>">

                <button type="submit">Excluir este projeto</button>

            </form>

            <hr>

    <?php
        }
    }

    // Mensagem para abas sem projetos
    if (!$encontrou) {
    ?>

        <p>Nenhum projeto nesta aba.</p>

    <?php } ?>

    <script>
        // Localiza todos os formulários de resposta
        document.querySelectorAll(".form-resposta").forEach(function(form) {

            // Localiza o seletor de aprovação ou reprovação
            const seletor = form.querySelector('[name="resposta"]');

            // Localiza o campo do orçamento
            const campo = form.querySelector(".campo-orcamento");

            // Localiza o campo onde o valor será digitado
            const input = campo.querySelector('[name="orcamento"]');

            // Atualiza a exibição quando a resposta muda
            function atualizarOrcamento() {

                // Verifica se a equipe escolheu reprovar
                const recusado = seletor.value == "REPROVAR";

                // Esconde o orçamento quando o projeto é recusado
                campo.style.display = recusado ? "none" : "block";

                // Desativa o campo para não enviar orçamento na recusa
                input.disabled = recusado;

                // Exige orçamento somente para projetos aprovados
                input.required = !recusado;
            }

            // Executa a função quando o seletor é alterado
            seletor.addEventListener("change", atualizarOrcamento);

            // Define a exibição inicial do orçamento
            atualizarOrcamento();
        });
    </script>

</body>
</html>