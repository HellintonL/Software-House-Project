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
    <link rel="stylesheet" href="../style/empresa.css">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../style/equipe-ti.css">
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
            <a href="consultar-projeto.php">Consultar projeto</a>
        </nav>
    </header>

    <main>
        <section class="cadastro">
            <div class="titulo-secao">
                <p>Etapa 3 do processo</p>
                <h1>Análise interna da demanda</h1>
                <p>Valide a solicitação do cliente, defina a viabilidade do projeto e encaminhe a proposta comercial.</p>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
                <a class="aba <?= $aba == 'aguardando' ? 'ativa' : '' ?>"
                   href="equipe-ti.php?aba=aguardando">
                    Aguardando avaliação
                </a>

                <a class="aba <?= $aba == 'respondidos' ? 'ativa' : '' ?>"
                   href="equipe-ti.php?aba=respondidos">
                    Projetos respondidos
                </a>
            </div>

            <?php if (isset($_GET["erro"]) && $_GET["erro"] == "orcamento") { ?>
                <p class="mensagem erro" role="status">Informe um orçamento válido para aprovar o projeto.</p>
            <?php } ?>

            <?php if (!empty($projetos)) { ?>
                <form method="POST" onsubmit="return confirm('Deseja excluir TODOS os projetos?');" style="margin-bottom: 25px;">
                    <input type="hidden" name="acao" value="limpar_todos">
                    <input type="hidden" name="aba" value="<?= $aba ?>">
                    <button type="submit">Excluir todos os projetos</button>
                </form>
            <?php } ?>

            <?php
            $encontrou = false;
            foreach ($projetos as $indice => $projeto) {
                $temResposta = isset($projeto["resposta"]);

                if (($aba == "respondidos" && $temResposta) || ($aba == "aguardando" && !$temResposta)) {
                    $encontrou = true;
            ?>
                    <div style="border: 1px solid #dfe7ee; border-radius: 8px; padding: 20px; margin-bottom: 20px; background: #f8fbfd;">
                        <h2 style="margin: 0 0 15px; color: #173746; font-size: 24px;">
                            <?= htmlspecialchars($projeto["nome_projeto"]) ?>
                        </h2>

                        <p><strong>Cliente:</strong> <?= htmlspecialchars($projeto["nome"]) ?></p>
                        <p><strong>E-mail:</strong> <?= htmlspecialchars($projeto["email"]) ?></p>
                        <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($projeto["descricao"])) ?></p>

                        <?php if ($temResposta) { ?>
                            <?php if ($projeto["resposta"] == "REPROVAR") { ?>
                                <p><strong>Resultado:</strong> Recusado.</p>
                            <?php } else { ?>
                                <p><strong>Resultado:</strong> Aprovado!</p>
                                <p>
                                    <strong>Orçamento:</strong>
                                    R$ <?= number_format((float)($projeto["orcamento"] ?? 0), 2, ',', '.') ?>
                                </p>
                            <?php } ?>
                        <?php } else { ?>
                            <form method="POST" class="form-resposta" style="margin-top: 20px;">
                                <input type="hidden" name="acao" value="responder">
                                <input type="hidden" name="indice" value="<?= $indice ?>">
                                <input type="hidden" name="aba" value="<?= $aba ?>">

                                <label>Resposta final:</label>
                                <select name="resposta">
                                    <option value="APROVAR">APROVAR</option>
                                    <option value="REPROVAR">REPROVAR</option>
                                </select>

                                <div class="campo-orcamento">
                                    <label>Orçamento do projeto (R$):</label>
                                    <input type="number" name="orcamento" min="0" step="0.01" required>
                                </div>

                                <button type="submit">Enviar resposta</button>
                            </form>

                            <p style="margin-top: 15px;"><strong>Status:</strong> Aguardando avaliação</p>
                        <?php } ?>

                        <form method="POST" onsubmit="return confirm('Deseja excluir este projeto?');" style="margin-top: 18px;">
                            <input type="hidden" name="acao" value="excluir_um">
                            <input type="hidden" name="indice" value="<?= $indice ?>">
                            <input type="hidden" name="aba" value="<?= $aba ?>">
                            <button type="submit">Excluir este projeto</button>
                        </form>
                    </div>
            <?php
                }
            }

            if (!$encontrou) {
                echo '<p class="mensagem erro">Nenhum projeto nesta aba.</p>';
            }
            ?>
        </section>
    </main>

    <footer>
        <p>Desenvolvido pelo Grupo APD</p>
        <p>HTML + CSS + PHP + JSON</p>
    </footer>

    <script>
        document.querySelectorAll('.form-resposta').forEach(function(form) {
            const seletor = form.querySelector('[name="resposta"]');
            const campo = form.querySelector('.campo-orcamento');
            const input = campo.querySelector('[name="orcamento"]');

            function atualizarOrcamento() {
                const recusado = seletor.value == 'REPROVAR';
                campo.style.display = recusado ? 'none' : 'block';
                input.disabled = recusado;
                input.required = !recusado;
            }

            seletor.addEventListener('change', atualizarOrcamento);
            atualizarOrcamento();
        });
    </script>

</body>
</html>