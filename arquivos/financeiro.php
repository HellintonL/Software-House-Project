<?php

$mensagem = '';
$tipoMensagem = '';

$dados = [
    'cliente' => '',
    'empresa' => '',
    'projeto' => '',
    'valor' => '',
    'status' => '',
    'observacoes' => ''
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
        $dados['status'] === ''
    ) {
        $mensagem = 'Preencha todos os campos obrigatórios do financeiro.';
        $tipoMensagem = 'erro';
    } elseif (!is_numeric(str_replace(',', '.', $dados['valor']))) {
        $mensagem = 'Informe um valor numérico válido.';
        $tipoMensagem = 'erro';
    } else {
        $mensagem = 'Status financeiro atualizado com sucesso!';
        $tipoMensagem = 'sucesso';

        foreach ($dados as $campo => $valor) {
            if (in_array($campo, ['cliente', 'empresa', 'projeto', 'valor', 'status', 'observacoes'], true)) {
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
    <title>Financeiro | APD</title>
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
        <a href="consultar-projeto.php">Consultar projeto</a>
    </nav>
</header>

<main>
    <section class="cadastro">
        <div class="titulo-secao">
            <p>Etapa 7 do processo</p>
            <h1>Financeiro</h1>
            <p>Atualize o status do pagamento do projeto e mantenha o acompanhamento financeiro do cliente.</p>
        </div>

        <?php if ($mensagem !== ''): ?>
            <p class="mensagem <?= escapar($tipoMensagem) ?>" role="status">
                <?= escapar($mensagem) ?>
            </p>
        <?php endif; ?>

        <form action="financeiro.php" method="post">
            <label for="cliente">Nome do cliente *</label>
            <input type="text" id="cliente" name="cliente" value="<?= escapar($dados['cliente']) ?>" required>

            <label for="empresa">Nome da empresa *</label>
            <input type="text" id="empresa" name="empresa" value="<?= escapar($dados['empresa']) ?>" required>

            <label for="projeto">Nome do projeto *</label>
            <input type="text" id="projeto" name="projeto" value="<?= escapar($dados['projeto']) ?>" required>

            <label for="valor">Valor do contrato (R$) *</label>
            <input type="text" id="valor" name="valor" value="<?= escapar($dados['valor']) ?>" placeholder="Ex: 1500.00" required>

            <label for="status">Status do pagamento *</label>
            <select id="status" name="status" required>
                <option value="">Selecione</option>
                <option value="pendente">Pendente</option>
                <option value="aprovado">Aprovado</option>
                <option value="rejeitado">Rejeitado</option>
            </select>

            <label for="observacoes">Observações</label>
            <textarea id="observacoes" name="observacoes" rows="4"><?= escapar($dados['observacoes']) ?></textarea>

            <button type="submit">Salvar financeiro</button>

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
