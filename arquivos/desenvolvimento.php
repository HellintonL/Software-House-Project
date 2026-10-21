<?php

$mensagem = '';
$tipoMensagem = '';

$dados = [
    'cliente' => '',
    'empresa' => '',
    'projeto' => '',
    'status' => '',
    'responsavel' => '',
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
        $dados['status'] === '' ||
        $dados['responsavel'] === ''
    ) {
        $mensagem = 'Preencha todos os campos obrigatórios do desenvolvimento.';
        $tipoMensagem = 'erro';
    } else {
        $mensagem = 'Status do desenvolvimento atualizado com sucesso!';
        $tipoMensagem = 'sucesso';

        foreach ($dados as $campo => $valor) {
            if (in_array($campo, ['cliente', 'empresa', 'projeto', 'status', 'responsavel', 'observacoes'], true)) {
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
    <title>Desenvolvimento | APD</title>
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
            <p>Etapa 8 do processo</p>
            <h1>Desenvolvimento</h1>
            <p>Defina o status do projeto em desenvolvimento para manter o cliente informado sobre o andamento.</p>
        </div>

        <?php if ($mensagem !== ''): ?>
            <p class="mensagem <?= escapar($tipoMensagem) ?>" role="status">
                <?= escapar($mensagem) ?>
            </p>
        <?php endif; ?>

        <form action="desenvolvimento.php" method="post">
            <label for="cliente">Nome do cliente *</label>
            <input type="text" id="cliente" name="cliente" value="<?= escapar($dados['cliente']) ?>" required>

            <label for="empresa">Nome da empresa *</label>
            <input type="text" id="empresa" name="empresa" value="<?= escapar($dados['empresa']) ?>" required>

            <label for="projeto">Nome do projeto *</label>
            <input type="text" id="projeto" name="projeto" value="<?= escapar($dados['projeto']) ?>" required>

            <label for="responsavel">Responsável pelo projeto *</label>
            <input type="text" id="responsavel" name="responsavel" value="<?= escapar($dados['responsavel']) ?>" required>

            <label for="status">Status do desenvolvimento *</label>
            <select id="status" name="status" required>
                <option value="">Selecione</option>
                <option value="pendente">Pendente</option>
                <option value="em_desenvolvimento">Em desenvolvimento</option>
                <option value="entregue">Entregue</option>
            </select>

            <label for="observacoes">Observações</label>
            <textarea id="observacoes" name="observacoes" rows="4"><?= escapar($dados['observacoes']) ?></textarea>

            <button type="submit">Salvar status</button>

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
