<?php

function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$projeto = "";
$cliente = "";
$descricao = "";

$quantidade = 1;
$preco = 0;
$total = 0;

$calculado = false;
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projeto = trim($_POST["projeto"] ?? "");
    $cliente = trim($_POST["cliente"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");

    $quantidade = $_POST["quantidade"] ?? "";
    $preco = $_POST["preco"] ?? "";

    $preco = str_replace(",", ".", (string) $preco);

    if ($projeto === "" || $cliente === "" || $quantidade === "" || $preco === "") {
        $erro = "Preencha todos os campos obrigatórios.";
    } elseif (!is_numeric($quantidade) || !is_numeric($preco)) {
        $erro = "Digite valores numéricos válidos.";
    } elseif ((float) $quantidade <= 0 || (float) $quantidade != (int) $quantidade || (float) $preco < 0) {
        $erro = "Confira a quantidade e o preço informados.";
    } else {
        $quantidade = (int) $quantidade;
        $preco = (float) $preco;
        $total = $quantidade * $preco;
        $calculado = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento | APD</title>
    <link rel="stylesheet" href="../style/empresa.css">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="shortcut icon" href="../imagens/logo.png" type="image/x-icon">
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
        <a href="../index.php#sobre">Sobre a empresa</a>
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
            <p>Etapa 4 do processo</p>
            <h1>Proposta comercial / orçamento</h1>
            <p>Após a análise da demanda, esta etapa formaliza a proposta com valor, prazo e condições do projeto.</p>
        </div>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $erro !== ""): ?>
            <p class="mensagem erro" role="status">
                <?= escapar($erro) ?>
            </p>
        <?php endif; ?>

        <form action="orcamento.php" method="POST">
            <label for="projeto">Nome do projeto *</label>
            <input
                type="text"
                id="projeto"
                name="projeto"
                value="<?= escapar($projeto) ?>"
                required
            >

            <label for="cliente">Nome do cliente *</label>
            <input
                type="text"
                id="cliente"
                name="cliente"
                value="<?= escapar($cliente) ?>"
                required
            >

            <label for="descricao">Descrição do projeto</label>
            <textarea id="descricao" name="descricao" rows="4"><?= escapar($descricao) ?></textarea>

            <label for="quantidade">Quantidade de unidades *</label>
            <input
                type="number"
                id="quantidade"
                name="quantidade"
                min="1"
                step="1"
                value="<?= escapar((string) $quantidade) ?>"
                required
            >

            <label for="preco">Preço por unidade (R$) *</label>
            <input
                type="number"
                id="preco"
                name="preco"
                min="0"
                step="0.01"
                value="<?= escapar((string) $preco) ?>"
                required
            >

            <button type="submit">Calcular orçamento</button>

            <p class="aviso-cadastro">
                * Campos obrigatórios.
            </p>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $calculado): ?>
            <div class="mensagem sucesso" role="status" style="margin-top: 25px;">
                <h2 style="margin-bottom: 15px; color: #173746;">Resumo do orçamento</h2>

                <p><strong>Projeto:</strong> <?= escapar($projeto) ?></p>
                <p><strong>Cliente:</strong> <?= escapar($cliente) ?></p>
                <p><strong>Descrição:</strong> <?= nl2br(escapar($descricao)) ?></p>
                <p><strong>Quantidade:</strong> <?= $quantidade ?></p>
                <p><strong>Preço por unidade:</strong> R$ <?= number_format($preco, 2, ',', '.') ?></p>
                <p><strong>Total:</strong> R$ <?= number_format($total, 2, ',', '.') ?></p>

                <button type="button" style="margin-top: 20px;" onclick="window.print()">
                    Imprimir orçamento
                </button>
            </div>
        <?php endif; ?>
    </section>
</main>

<footer>
    <p>Desenvolvido pelo Grupo APD</p>
    <p>HTML + CSS + PHP + JSON</p>
</footer>

</body>
</html>