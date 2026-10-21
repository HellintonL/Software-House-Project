<?php

$mensagem = '';
$tipoMensagem = '';

$dados = [
    'cliente' => '',
    'empresa' => '',
    'projeto' => '',
    'valor' => '',
    'prazo' => '',
    'condicoes' => '',
    'assina_cliente' => '',
    'assina_empresa' => ''
];

function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($dados as $campo => $valor) {
        $dados[$campo] = trim($_POST[$campo] ?? '');
    }

    if (
        $dados['cliente'] === '' ||
        $dados['empresa'] === '' ||
        $dados['projeto'] === '' ||
        $dados['valor'] === '' ||
        $dados['prazo'] === '' ||
        $dados['condicoes'] === ''
    ) {
        $mensagem = 'Preencha todos os campos obrigatórios do contrato.';
        $tipoMensagem = 'erro';
    } elseif (!is_numeric(str_replace(',', '.', $dados['valor']))) {
        $mensagem = 'Informe um valor numérico válido para o contrato.';
        $tipoMensagem = 'erro';
    } else {
        $mensagem = 'Contrato preparado com sucesso!';
        $tipoMensagem = 'sucesso';

        foreach ($dados as $campo => $valor) {
            if (in_array($campo, ['cliente', 'empresa', 'projeto', 'valor', 'prazo', 'condicoes', 'assina_cliente', 'assina_empresa'], true)) {
                $dados[$campo] = '';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato | APD</title>
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
        <a href="consultar-projeto.php">Consultar projeto</a>
    </nav>
</header>

<main>
    <section class="cadastro">
        <div class="titulo-secao">
            <p>Etapa 6 do processo</p>
            <h1>Contrato e assinatura</h1>
            <p>Depois da proposta aprovada, este documento formaliza o acordo entre cliente e empresa.</p>
        </div>

        <?php if ($mensagem !== ''): ?>
            <p class="mensagem <?= escapar($tipoMensagem) ?>" role="status">
                <?= escapar($mensagem) ?>
            </p>
        <?php endif; ?>

        <form action="contrato.php" method="post">
            <label for="cliente">Nome do cliente *</label>
            <input type="text" id="cliente" name="cliente" value="<?= escapar($dados['cliente']) ?>" required>

            <label for="empresa">Nome da empresa *</label>
            <input type="text" id="empresa" name="empresa" value="<?= escapar($dados['empresa']) ?>" required>

            <label for="projeto">Nome do projeto *</label>
            <input type="text" id="projeto" name="projeto" value="<?= escapar($dados['projeto']) ?>" required>

            <label for="valor">Valor do contrato (R$) *</label>
            <input type="text" id="valor" name="valor" value="<?= escapar($dados['valor']) ?>" placeholder="Ex: 7500.00" required>

            <label for="prazo">Prazo de execução *</label>
            <input type="text" id="prazo" name="prazo" value="<?= escapar($dados['prazo']) ?>" placeholder="Ex: 45 dias" required>

            <label for="condicoes">Condições do contrato *</label>
            <textarea id="condicoes" name="condicoes" rows="4" required><?= escapar($dados['condicoes']) ?></textarea>

            <label for="assina_cliente">Assinatura do cliente</label>
            <input type="text" id="assina_cliente" name="assina_cliente" value="<?= escapar($dados['assina_cliente']) ?>" placeholder="Nome do responsável do cliente">

            <label for="assina_empresa">Assinatura da empresa</label>
            <input type="text" id="assina_empresa" name="assina_empresa" value="<?= escapar($dados['assina_empresa']) ?>" placeholder="Nome do responsável da empresa">

            <button type="submit">Gerar contrato</button>

            <p class="aviso-cadastro">
                * Campos obrigatórios.
            </p>
        </form>
    </section>
</main>

<footer>
    <p>Desenvolvido pelo Grupo APD</p>
    <p>HTML + CSS + PHP + JSON</p>
</footer>

</body>
</html>
