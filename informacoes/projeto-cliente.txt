<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="projeto-cliente.css">
</head>
<body>
    <h1>Fale sobre seu projeto</h1>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome">
        <br>
        <label>Cpf:</label>
        <input type="text" name="cpf">
        <br>
        <label>Tema do projeto:</label>
        <input type="text" name="projeto">
        <br>
        <label>Escreva sobre projeto:</label>
        <br>
        <textarea id="descricao" name="descricao" rows="5" cols="40" required></textarea>
        <button type="submit">Enviar projeto</button>
    </form>
</body>
</html>