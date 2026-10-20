<?php



// 1. Valores iniciais

$nomeProjeto = "";

$nomeCliente = "";

$descricao = "";

$quantidade = 1;

$preco = 0;

$total = 0;

$calculado = false;

$erro = "";



// 2. Verifica se o formulário foi enviado

if ($_SERVER["REQUEST_METHOD"] === "POST") {



    // Recebe os dados do formulário

    $nomeProjeto = trim($_POST["projeto"] ?? "");

    $nomeCliente = trim($_POST["cliente"] ?? "");

    $descricao = trim($_POST["descricao"] ?? "");



    // Valida a quantidade

    $qtdRecebida = filter_var(

        $_POST["quantidade"] ?? null,

        FILTER_VALIDATE_INT

    );



    // Valida o preço

    $precoRecebido = filter_var(

        $_POST["preco"] ?? null,

        FILTER_VALIDATE_FLOAT

    );



    // Guarda os valores válidos para reapresentá-los no formulário

    if ($qtdRecebida !== false && $qtdRecebida !== null) {

        $quantidade = $qtdRecebida;

    }



    if (

        $precoRecebido !== false &&

        $precoRecebido !== null &&

        is_finite((float) $precoRecebido)

    ) {

        $preco = (float) $precoRecebido;

    }



    // 3. Verifica se os dados estão corretos

    if (

        $nomeProjeto !== "" &&

        $nomeCliente !== "" &&

        $qtdRecebida !== false &&

        $qtdRecebida !== null &&

        $qtdRecebida > 0 &&

        $precoRecebido !== false &&

        $precoRecebido !== null &&

        is_finite((float) $precoRecebido) &&

        $precoRecebido >= 0

    ) {



        // 4. Calcula o orçamento

        $quantidade = $qtdRecebida;

        $preco = (float) $precoRecebido;



        $total = $quantidade * $preco;



        $calculado = true;



    } else {

        $erro = "Confira os dados informados e tente novamente.";

    }

}



// 5. Protege os textos exibidos na página

function escapar($texto) {

    return htmlspecialchars(

        (string) $texto,

        ENT_QUOTES,

        "UTF-8"

    );

}



// 6. Formata os valores em reais

function moeda($valor) {

    return "R$ " . number_format(

        $valor,

        2,

        ",",

        "."

    );

}



?>



<!DOCTYPE html>

<html lang="pt-BR">



<head>

    <meta charset="UTF-8">



    <meta name="viewport"

          content="width=device-width, initial-scale=1.0">



    <title>Orçamento de Projetos</title>



    <style>

        * {

            box-sizing: border-box;

        }



        body {

            margin: 0;

            padding: 30px 15px;

            font-family: Arial, sans-serif;

            background: #f1f5f9;

            color: #1e293b;

        }



        .container {

            max-width: 800px;

            margin: auto;

        }



        .cabecalho {

            margin-bottom: 25px;

        }



        .cabecalho h1 {

            margin-bottom: 8px;

            color: #1d4ed8;

        }



        /* Navegação do site */

        nav {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            margin-bottom: 25px;

        }



        nav a {

            display: inline-block;

            text-decoration: none;

            background: #2563eb;

            color: white;

            padding: 10px 15px;

            border-radius: 7px;

            font-weight: bold;

        }



        nav a:hover {

            background: #1d4ed8;

        }



        /* Cartões de conteúdo */

        .card {

            background: white;

            padding: 25px;

            border-radius: 12px;

            margin-bottom: 20px;

            box-shadow: 0 4px 15px #0000000a;

        }



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

            border-radius: 7px;

            font: inherit;

        }



        input:focus,

        textarea:focus {

            outline: 2px solid #93c5fd;

            border-color: #2563eb;

        }



        button {

            background: #2563eb;

            color: white;

            border: none;

            padding: 13px 20px;

            border-radius: 7px;

            font-weight: bold;

            cursor: pointer;

        }



        button:hover {

            background: #1d4ed8;

        }



        /* Resultado do orçamento */

        .resultado {

            border-top: 4px solid #16a34a;

        }



        .total {

            font-size: 28px;

            color: #15803d;

            font-weight: bold;

        }



        .erro {

            background: #fee2e2;

            color: #b91c1c;

            padding: 15px;

            border-radius: 7px;

            font-weight: bold;

        }



        /* Ajustes para celular */

        @media (max-width: 600px) {

            body {

                padding: 15px 10px;

            }



            .card {

                padding: 18px;

            }

        }



        /* Ajustes para impressão */

        @media print {

            nav,

            form,

            .nao-imprimir {

                display: none;

            }



            body {

                background: white;

                padding: 0;

            }



            .card {

                box-shadow: none;

            }

        }

    </style>



</head>



<body>



<div class="container">



    <!-- Cabeçalho -->

    <header class="cabecalho">

        <h1>Orçamento de Projetos</h1>



        <p>

            Preencha os dados para calcular o orçamento.

        </p>

    </header>



    <!-- Menu de navegação -->

    <nav>

        <a href="software-house.php">Enviar projeto</a>



        <a href="equipe-ti.php">Área da equipe de T.I.</a>



        <a href="consultar-projeto.php">Consultar projeto</a>



        <a href="orcamento.php">Consultar orçamento</a>



        <a href="../index.php">Página inicial</a>

    </nav>



    <!-- Formulário -->

    <form method="POST" action="orcamento.php">



        <section class="card">



            <h2>Dados do projeto</h2>



            <div class="campo">

                <label for="projeto">

                    Nome do projeto

                </label>



                <input

                    type="text"

                    id="projeto"

                    name="projeto"

                    value="<?= escapar($nomeProjeto) ?>"

                    required

                >

            </div>



            <div class="campo">

                <label for="cliente">

                    Nome do cliente

                </label>



                <input

                    type="text"

                    id="cliente"

                    name="cliente"

                    value="<?= escapar($nomeCliente) ?>"

                    required

                >

            </div>



            <div class="campo">

                <label for="descricao">

                    Descrição do projeto

                </label>



                <textarea

                    id="descricao"

                    name="descricao"

                    rows="4"

                ><?= escapar($descricao) ?></textarea>

            </div>



        </section>



        <section class="card">



            <h2>Custos do projeto</h2>



            <div class="campo">

                <label for="quantidade">

                    Quantidade de unidades

                </label>



                <input

                    type="number"

                    id="quantidade"

                    name="quantidade"

                    min="1"

                    step="1"

                    value="<?= escapar($quantidade) ?>"

                    required

                >

            </div>



            <div class="campo">

                <label for="preco">

                    Preço por unidade (R$)

                </label>



                <input

                    type="number"

                    id="preco"

                    name="preco"

                    min="0"

                    step="0.01"

                    value="<?= escapar($preco) ?>"

                    required

                >

            </div>



        </section>



        <button type="submit">

            Calcular orçamento

        </button>



    </form>



    <!-- Resultado ou mensagem de erro -->

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>



        <?php if ($calculado): ?>



            <section class="card resultado">



                <h2>Resumo do orçamento</h2>



                <p>

                    <strong>Projeto:</strong>

                    <?= escapar($nomeProjeto) ?>

                </p>



                <p>

                    <strong>Cliente:</strong>

                    <?= escapar($nomeCliente) ?>

                </p>



                <p>

                    <strong>Descrição:</strong>

                    <?= nl2br(escapar($descricao)) ?>

                </p>



                <p>

                    <strong>Quantidade:</strong>

                    <?= escapar($quantidade) ?>

                </p>



                <p>

                    <strong>Preço unitário:</strong>

                    <?= moeda($preco) ?>

                </p>



                <p class="total">

                    Total: <?= moeda($total) ?>

                </p>



                <button

                    type="button"

                    class="nao-imprimir"

                    onclick="window.print()"

                >

                    Imprimir orçamento

                </button>



            </section>



        <?php else: ?>



            <p class="erro">

                <?= escapar($erro) ?>

            </p>



        <?php endif; ?>



    <?php endif; ?>



</div>



</body>

</html>