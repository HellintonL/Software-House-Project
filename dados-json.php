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

    $novaEmpresa = "empresa" => [
        "razaoSocial" => $razaoSocial,
        "nomeFantasia" => $nomeFantasia,
        "cnpj" => $cnpj,
    ],
    


