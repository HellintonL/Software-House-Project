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

<style>

/* Configurações gerais */
* {
box-sizing: border-box;
}

body {
margin: 0;
padding: 25px 15px;
font-family: Arial, sans-serif;
background-color: #f1f5f9;
color: #1e293b;
}

.container {
max-width: 800px;
margin: auto;
}

/* Título da página */
header {
margin-bottom: 20px;
}

h1 {
color: #1d4ed8;
}

/* Menu de navegação */
nav {
display: flex;
flex-wrap: wrap;
gap: 10px;
margin-bottom: 25px;
}

nav a {
background-color: #2563eb;
color: white;
padding: 10px 15px;
text-decoration: none;
border-radius: 7px;
}

nav a:hover {
background-color: #1d4ed8;
}

/* Caixas do formulário */
.card {
background-color: white;
padding: 22px;
border-radius: 10px;
margin-bottom: 20px;
}

/* Campos de preenchimento */
.campo {
margin-bottom: 18px;
}

label {
display: block;
margin-bottom: 7px;
font-weight: bold;
}

input,
textarea {
width: 100%;
padding: 12px;
border: 1px solid #cbd5e1;
border-radius: 6px;
font: inherit;
}

/* Botões */
button {
background-color: #2563eb;
color: white;
padding: 12px 18px;
border: none;
border-radius: 6px;
cursor: pointer;
font-weight: bold;
}

button:hover {
background-color: #1d4ed8;
}

/* Resultado do cálculo */
.resultado {
border-top: 4px solid #16a34a;
}

.total {
color: #15803d;
font-size: 26px;
font-weight: bold;
}

/* Mensagem de erro */
.erro {
background-color: #fee2e2;
color: #b91c1c;
padding: 15px;
border-radius: 6px;
}

/* Ajustes para celular */
@media (max-width: 600px) {
body {
padding: 15px 10px;
}

.card {
padding: 16px;
}
}

/* Esconde os campos ao imprimir */
@media print {
nav,
form,
.nao-imprimir {
display: none;
}

body {
background-color: white;
}
}

</style>

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