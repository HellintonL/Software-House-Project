<?php

// Variáveis para guardar os dados do orçamento
$projeto = "";
$cliente = "";
$descricao = "";

$quantidade = 1;
$preco = 0;
$total = 0;

$calculado = false;
$erro = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Recebe os dados digitados no formulário
$projeto = trim($_POST["projeto"] ?? "");
$cliente = trim($_POST["cliente"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");

$quantidade = $_POST["quantidade"] ?? "";
$preco = $_POST["preco"] ?? "";

// Permite digitar o preço com ponto ou vírgula
$preco = str_replace(",", ".", $preco);

// Verifica se os campos foram preenchidos
if (
$projeto == "" ||
$cliente == "" ||
$quantidade == "" ||
$preco == ""
) {

$erro = "Preencha todos os campos obrigatórios.";

} elseif (
!is_numeric($quantidade) ||
!is_numeric($preco)
) {

$erro = "Digite valores numéricos válidos.";

} elseif (
(float)$quantidade <= 0 ||
(float)$quantidade != (int)$quantidade ||
(float)$preco < 0
) {

$erro = "Confira a quantidade e o preço informados.";

} else {

// Converte os valores para números
$quantidade = (int)$quantidade;
$preco = (float)$preco;

// Calcula o valor total
$total = $quantidade * $preco;

// Informa que o cálculo foi realizado
$calculado = true;
}
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Orçamento de Projetos</title>



</head>

<body>

<div class="container">

<!-- Cabeçalho -->
<header>

<h1>Orçamento de Projetos</h1>

<p>Preencha os dados para calcular o orçamento.</p>

</header>

<!-- Menu do site -->
<nav>

<a href="software-house.php">Enviar projeto</a>

<a href="equipe-t.i.php">Área da equipe de T.I.</a>

<a href="consultar-projeto.php">Consultar projeto</a>

<a href="../index.php">Página inicial</a>

</nav>

<!-- Formulário do orçamento -->
<form action="orcamento.php" method="POST">

<section class="card">

<h2>Dados do projeto</h2>

<div class="campo">

<label for="projeto">Nome do projeto:</label>

<input
type="text"
id="projeto"
name="projeto"
value="<?= htmlspecialchars($projeto) ?>"
required
>

</div>

<div class="campo">

<label for="cliente">Nome do cliente:</label>

<input
type="text"
id="cliente"
name="cliente"
value="<?= htmlspecialchars($cliente) ?>"
required
>

</div>

<div class="campo">

<label for="descricao">Descrição do projeto:</label>

<textarea
id="descricao"
name="descricao"
rows="4"
><?= htmlspecialchars($descricao) ?></textarea>

</div>

</section>

<section class="card">

<h2>Custos do projeto</h2>

<div class="campo">

<label for="quantidade">Quantidade de unidades:</label>

<input
type="number"
id="quantidade"
name="quantidade"
min="1"
step="1"
value="<?= htmlspecialchars((string)$quantidade) ?>"
required
>

</div>

<div class="campo">

<label for="preco">Preço por unidade (R$):</label>

<input
type="number"
id="preco"
name="preco"
min="0"
step="0.01"
value="<?= htmlspecialchars((string)$preco) ?>"
required
>

</div>

</section>

<button type="submit">
Calcular orçamento
</button>

</form>

<!-- Mostra o resultado ou o erro -->
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

<?php if ($calculado) { ?>

<section class="card resultado">

<h2>Resumo do orçamento</h2>

<p>
<strong>Projeto:</strong>
<?= htmlspecialchars($projeto) ?>
</p>

<p>
<strong>Cliente:</strong>
<?= htmlspecialchars($cliente) ?>
</p>

<p>
<strong>Descrição:</strong>
<?= nl2br(htmlspecialchars($descricao)) ?>
</p>

<p>
<strong>Quantidade:</strong>
<?= $quantidade ?>
</p>

<p>
<strong>Preço por unidade:</strong>
R$ <?= number_format($preco, 2, ",", ".") ?>
</p>

<p class="total">
Total: R$ <?= number_format($total, 2, ",", ".") ?>
</p>

<button
type="button"
class="nao-imprimir"
onclick="window.print()"
>
Imprimir orçamento
</button>

</section>

<?php } else { ?>

<p class="erro">
<?= htmlspecialchars($erro) ?>
</p>

<?php } ?>

<?php } ?>

</div>

</body>
</html>