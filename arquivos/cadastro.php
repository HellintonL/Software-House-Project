<?php
    $arquivo = __DIR__ . '/../dados/empresas.json';

                        //define a mensagem que irá aparecer ao usuário.
    $mensagem = '';

                        // Define o tipo de mensagem, sucesso ou erro.
    $tipoMensagem = '';

                        // Inicia os campos vazios para o formulário.
    $empresa = [
        'empresa' => '',
        'responsavel' => '',
        'email' => '',
        'telefone' => '',
        'cnpj' => '',
        'area' => '',
        'descricao' => ''
    ];

                        // Converte caracteres especiais em entidades HTML, evita que textos inseridos pelo
                        // Usuário sejam interpretados como código HTML ou JavaScript.
    function escapar($valor) {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }

                        // Verifica se a página recebeu o formulário no metodo POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                        // Recupera os dados do formulário e remove espaços em branco no início e no final.
        foreach ($empresa as $campo => $valor){
            $empresa[$campo] = trim($_POST[$campo] ?? '');
        }
    }

                        //Verifica se todos os campos obrigatórios foram preenchidos.
     if ($empresa['empresa'] === '' || $empresa['responsavel'] === '' ||
        $empresa['email'] === '' || $empresa['telefone'] === '' ||
        $empresa['area'] === '' || $empresa['descricao'] === '') 
    {
        $mensagem = 'Preencha todos os campos obrigatórios.';
        $tipoMensagem = 'erro';
    }

                        // Verifica se o e-mail informato está no formato correto.
    elseif(!filter_var($empresa['email'], FILTER_VALIDATE_EMAIL)) {
        $mensagem = 'Informe um endereço de e-mail válido.';
        $tipoMensagem = 'erro';
    }  

                        // Verifica se a área escolhida é uma das opções válidas.
    elseif(!in_array($empresa['area'],
            [
                'tecnologia',
                'industria',
                'comercio',
                'servicos',
                'outra'
            ], true)
    ) {
        $mensagem = 'Selecione uma área de atuação válida.';
        $tipoMensagem = 'erro';
    }

                        // Leitura dos cadastros existentes.
    else {

                        // Lê o conteúdo atual do arquivo JSON.
        $conteudo = file_get_contents($arquivo);

                        // Converte o JSON em um array PHP.
        $empresas = $conteudo !== false ? json_decode($conteudo, true) : null;

                        // Verifica se o conteúdo foi lido e convertido corretamente e se 
                        // representa uma lista de registros.
        if (!is_array($empresas) || json_last_error() !== JSON_ERROR_NONE) {
            $mensagem = 'Não foi possível ler os dados das empresas.';
            $tipoMensagem = 'erro';
        }

                        // Leitura dos cadastros existentes.
        else {

                        // Lê o conteúdo atual do arquivo JSON.
            $conteudo = file_get_contents($arquivo);

                        // converte o JSON em um array PHP.
            $empresas = $conteudo !== false ? json_decode($conteudo, true) : null; 
        
                        // Verifica se o conteúdo foi lido e convertido
                        // corretamente e se representa uma lista de registros.
            if (!is_array($empresas) || json_last_error() !== JSON_ERROR_NONE) {
                $mensagem = 'Não foi possível ler os dados das empresas.';
                $tipoMensagem = 'erro';
            }

                        // Preparação para o novo cadastro.
            else {
                        // Gera um identificador para o novo registro.  
                $empresa['id'] = uniqid('empresa_', true); 

                        // Registra a data e hora do cadastro.
                $empresa['data_cadastro'] = date('Y-m-d H:i:s');

                        // Adição de cadastro a lista de empresas.
                        // Acrescenta a empresa sem substituir os cadastros existentes.
                $empresas[] = $empresa;

                        // Converte o array de volta para JSON.
                        // Formata os dados para facilitar a leitura do arquivo.
                 $json = json_encode($empresas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE |
                    JSON_UNESCAPED_SLASHES);

                        // Verifica se a conversão para JSON foi bem-sucedida.);
            }
        

            

        }
    }





?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | APD</title>
    <link rel="stylesheet" href="../style/empresa.css">
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
        <a href="../index.php#projetos">Projetos</a>
        <a href="../index.php#contato">Contato</a>
    </nav>
</header>

<main>
    <section class="cadastro">
        <div class="titulo-secao">
            <p>Faça parte da APD</p>
            <h1>Cadastro de empresa</h1>
            <p>Preencha os dados para cadastrar sua empresa.</p>
        </div>

        <?php if ($mensagem !== ''): ?>
            <p class="mensagem <?= escapar($tipoMensagem) ?>" role="status">
                <?= escapar($mensagem) ?>
            </p>
        <?php endif; ?>

        <form action="cadastro.php" method="post">

            <label for="empresa">Nome da empresa *</label>
            <input type="text" id="empresa" name="empresa"
                   maxlength="150" required
                   value="<?= escapar($empresa['empresa']) ?>">

            <label for="responsavel">Nome do responsável *</label>
            <input type="text" id="responsavel" name="responsavel"
                   maxlength="150" required
                   value="<?= escapar($empresa['responsavel']) ?>">

            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email"
                   maxlength="254" required
                   value="<?= escapar($empresa['email']) ?>">

            <label for="telefone">Telefone *</label>
            <input type="tel" id="telefone" name="telefone"
                   maxlength="25" required
                   value="<?= escapar($empresa['telefone']) ?>">

            <label for="cnpj">CNPJ (opcional)</label>
            <input type="text" id="cnpj" name="cnpj"
                   maxlength="18"
                   placeholder="00.000.000/0000-00"
                   value="<?= escapar($empresa['cnpj']) ?>">

            <label for="area">Área de atuação *</label>
            <select id="area" name="area" required>
                <option value="">Selecione uma opção</option>
                <?php
                $areas = [
                    'tecnologia' => 'Tecnologia',
                    'industria' => 'Indústria',
                    'comercio' => 'Comércio',
                    'servicos' => 'Prestação de serviços',
                    'outra' => 'Outra'
                ];
                foreach ($areas as $valor => $nome):
                ?>
                    <option value="<?= escapar($valor) ?>"
                        <?= $empresa['area'] === $valor ? 'selected' : '' ?>>
                        <?= escapar($nome) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="descricao">Sobre a empresa *</label>
            <textarea id="descricao" name="descricao"
                      rows="4" maxlength="2000" required><?= escapar($empresa['descricao']) ?></textarea>

            <button type="submit">Enviar cadastro</button>

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