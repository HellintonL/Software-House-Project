<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar orçamento</title>
    <link rel="stylesheet" href="formulario.css">
    <link rel="stylesheet" href="projeto-cliente.css">
</head>

<body>

    <main class="formulario-container">

        <div class="formulario-titulo">
            <p>ORÇAMENTO PERSONALIZADO</p>
            <h1>Fale sobre seu projeto</h1>
            <span>
                Conte sua ideia e vamos encontrar a melhor
                solução para transformá-la em realidade.
            </span>
        </div>

        <form class="formulario" method="post">

            <div class="campo">
                <label for="nome">Nome completo</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite seu nome"
                    required
                >
            </div>

            <div class="campo">
                <label for="cpf">CPF</label>
                <input
                    type="text"
                    id="cpf"
                    name="cpf"
                    placeholder="Digite seu CPF"
                    required
                >
            </div>

            <div class="campo">
                <label for="projeto">Tema do projeto</label>
                <input
                    type="text"
                    id="projeto"
                    name="projeto"
                    placeholder="Ex.: Site para minha empresa"
                    required
                >
            </div>

            <div class="campo">
                <label for="descricao">Conte sobre seu projeto</label>
                <textarea
                    id="descricao"
                    name="descricao"
                    rows="5"
                    placeholder="Explique sua ideia, o que você precisa e como imagina o resultado..."
                    required
                ></textarea>
            </div>

            <button type="submit" class="botao-enviar">
                Enviar projeto
            </button>

            <p class="aviso">
                Após o envio, analisaremos sua ideia para preparar
                uma proposta personalizada.
            </p>

        </form>

    </main>

</body>
</html>