<?php

                                        // VERIFICA SE O FORMULÁRIO FOI ENVIADO 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $razaoSocial = $_POST["razao_social"];
        $nomeFantasia = $_POST["nome_fantasia"];
        $cnpj = $_POST["cnpj"];

        $email = $_POST["email"];
        $telefone = $_POST["telefone"];

        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];

        $descricao = $_POST["descricao"];
        $status = $_POST["status"];
        $orcamento = $_POST["orcamento"];

                                        // ORGANIZA OS DADOS DA NOVA EMPRESA

        $novaEmpresa = [
            "empresa" => [
                "razaoSocial" => $razaoSocial,
                "nomeFantasia" => $nomeFantasia,
                "cnpj" => $cnpj
            ],

            "contato" => [
                "email" => $email,
                "telefone" => $telefone
            ],

            "localizacao" => [
                "cidade" => $cidade,
                "estado" => $estado
            ],

            "projeto" => [
                "descricao" => $descricao,
                "status" => $status,
                "orcamento" => $orcamento
            ],

        ];


                                        // LÊ O ARQUIVO JSON EXISTENTE

        $caminhoArquivo = (__DIR__ . "/dados/empresas.json");

        $conteudoJson = file_get_contents($caminhoArquivo);

                                        // CONVERTE JSON PARA ARRAY PHP
                                        
        $empresas = json_decode($conteudoJson, true);

                                        // ADICIONA A NOVA EMPPRESA
                                        // NÃO EXISTE LIMITE 

        $empresas[] = $novaEmpresa;
        

                                        // CONVERTE ARRAY PHP PARA JSON

        $jsonAtualizado = json_encode(
            $empresas,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

                                        // SALVA NO ARQUIVO

        file_put_contents($caminhoArquivo, $jsonAtualizado, LOCK_EX);

    }

                                        // LÊ O JSON PARA EXIBIÇÃO

    $caminhoArquivo = (__DIR__ . "/empresas.json");
    $conteudoJson = file_get_contents($caminhoArquivo);

                                        // CONVERTE JSON PARA ARRAY PHP

    $empresas = json_decode($conteudoJson, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APD</title>
</head>
<body>
    <h1>Empresas</h1>
    <ul>
        <?php foreach ($empresas as $empresa): ?>
            <li>
                <strong><?php echo $empresa['empresa']['razaoSocial']; ?></strong> - <?php echo $empresa['empresa']['nomeFantasia']; ?> (<?php echo $empresa['empresa']['cnpj']; ?>)
                <br>
                <em><?php echo $empresa['contato']['email']; ?></em> - <?php echo $empresa['contato']['telefone']; ?>
                <br>
                <?php echo $empresa['localizacao']['cidade']; ?>, <?php echo $empresa['localizacao']['estado']; ?>
                <br>
                <?php echo $empresa['projeto']['descricao']; ?> - <?php echo $empresa['projeto']['status']; ?> - R$ <?php echo number_format($empresa['projeto']['orcamento'], 2, ',', '.'); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
