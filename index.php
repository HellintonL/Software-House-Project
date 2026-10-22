<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APD</title>
    <link rel="stylesheet" href="style/empresa.css">
    <link rel="shortcut icon" href="imagens/logo.png" type="image/x-icon" width="245px" height="100px">
</head>
<body>
    <header>
        <div class="logo">            
            <img src="imagens/cabecalho.png" alt="logo da empresa" width="245px" height="100px">
        </div>

        <nav>
            <a href="#inicio">Início</a>
            <a href="#sobre">Sobre a empresa</a>
            <a href="arquivos/cadastro.php">Cadastro</a>
            <a href="arquivos/software-house.php">Solicitar projeto</a>
            <a href="arquivos/equipe-ti.php">Análise interna</a>
            <a href="arquivos/orcamento.php">Orçamento</a>
            <a href="arquivos/contra-proposta.php">Contra proposta</a>
            <a href="arquivos/contrato.php">Contrato</a>
            <a href="arquivos/financeiro.php">Financeiro</a>
            <a href="arquivos/desenvolvimento.php">Desenvolvimento</a>
            <a href="arquivos/consultar-projeto.php">Consultar projeto</a>
            <a href="#contato">Contato</a>
        </nav>
    </header>
    
    <main>
           <section id="inicio" class="inicio">
            <div class="inicio-conteudo">
                <p class="apresentacao">Olá, somos a empresa</p>
                <h1>APD</h1>
                <h2>Desenvolvedores de software</h2>
                <p class="descricao">
                Nossa empresa é especializada na execução de projetos personalizados, transformando as ideias de nossos clientes em realidade. Trabalhamos com compromisso, qualidade e eficiência, buscando sempre atender às necessidades e expectativas de cada cliente.
                </p>
            </div>

            <div class="botoes">
                <a href="arquivos/cadastro.php" class="botao">Cadastrar empresa</a>
                <a href="arquivos/software-house.php" class="botao botao-secundario">Solicitar projeto</a>
            </div>
           </section>

            <section id="sobre" class="sobre">
                <div class="titulo-secao">
                    <p>Conheça um pouco</p>
                    <h2>Sobre a empresa</h2>
                </div>

                <div class="especialidades">
                    </div>
                    
                    <div class="sobre-conteudo">
                        <div class="sobre-texto"> 
                            <p>
                                Nossa empresa é especializada no desenvolvimento e na execução de projetos personalizados, transformando as ideias e necessidades de nossos clientes em soluções concretas. Trabalhamos com dedicação, responsabilidade e profissionalismo, buscando compreender cada demanda e oferecer soluções eficientes, sempre priorizando a qualidade, a organização e o cumprimento dos prazos estabelecidos.
                            </p>
                            <p>
                                Nosso compromisso é acompanhar cada etapa do projeto, desde o planejamento inicial até a sua conclusão, garantindo que os resultados estejam alinhados às expectativas e aos objetivos de nossos clientes. Prezamos pela excelência na execução dos serviços, pela confiança nas relações profissionais e pela satisfação de cada cliente, oferecendo soluções que agregam valor e atendem às necessidades de cada projeto.
                            </p>
                        </div>
                        <div class="habilidades">
                            <h2>Nossas especialidades</h2>
                            <div class="habilidade">
                            <h3>HTML</h3>
                            <p>Estruturação de páginas web.</p>
                        </div>  
                        <div class="habilidade">
                            <h3>CSS</h3>
                            <p>Estilização e criação de interface.</p>
                        </div>
                        <div class="habilidade">
                            <h3>PHP</h3>
                            <p>Desenvolvimento de aplicações web.</p>
                        </div>
                        <div class="habilidade">
                            <h3>JavaScript</h3>
                            <p>Interatividade e dinamismo em páginas web.</p>
                        </div>
                        <div class="habilidade">
                            <h3>JSON</h3>
                            <p>Armazenamento e troca de dados estruturados.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="projetos" class="projetos-secao">
                <div class="projetos">

                <!-- ETAPA 1 -->

                <div class="card">

                    <div class="icone-projeto">
                        ♙
                    </div>

                    <h3>Cadastro</h3>
                    <p>
                         Cadastre sua empresa e seus dados para iniciar o processo comercial e manter o histórico do cliente.
                    </p>
                    <a href="arquivos/cadastro.php">Acessar cadastro</a>
                </div>

                <!-- ETAPA 2 -->

                <div class="card">

                    <div class="icone-projeto">
                        ◇
                    </div>

                    <h3>Solicitar projeto</h3>
                    <p>
                        Conte-nos sobre seu projeto, seus objetivos e o que você deseja construir. Vamos analisar sua ideia e preparar uma proposta personalizada para você.
                    </p>
                    <a href="arquivos/software-house.php">Apresentar projeto</a>
                </div>

                <!-- ETAPA 3 -->

                <div class="card">

                    <div class="icone-projeto">
                        ✓
                    </div>

                    <h3>Análise interna</h3>
                    <p>
                        A equipe valida a demanda, verifica a viabilidade e encaminha a resposta da solicitação.
                    </p>
                    <a href="arquivos/equipe-ti.php">Ver análise</a>
                </div>

                <!-- ETAPA 4 -->
                <div class="card">

                    <div class="icone-projeto">
                        R$
                    </div>

                    <h3>Orçamento</h3>
                    <p>
                        Definimos valor, prazo e condições com base na análise da demanda e do escopo solicitado.
                    </p>
                    <a href="arquivos/orcamento.php">Ver orçamento e prazo</a>
                </div>

                <!-- ETAPA 5 -->
                <div class="card">

                    <div class="icone-projeto">
                        ↺
                    </div>

                    <h3>Contra proposta</h3>
                    <p>
                        O cliente pode ajustar valor, prazo, escopo ou condições para reabrir a negociação.
                    </p>
                    <a href="arquivos/contra-proposta.php">Enviar contra proposta</a>
                </div>

                <!-- ETAPA 6 -->
                <div class="card">

                    <div class="icone-projeto">
                        ☑
                    </div>

                    <h3>Contrato</h3>
                    <p>
                        Quando aprovado, formalizamos o acordo e seguimos para a assinatura do cliente e da empresa.
                    </p>
                    <a href="arquivos/contrato.php">Gerar contrato</a>
                </div>

                <!-- ETAPA 7 -->
                <div class="card">

                    <div class="icone-projeto">
                        ₿
                    </div>

                    <h3>Financeiro</h3>
                    <p>
                        Acompanhe o status do pagamento e mantenha o projeto em situação financeira correta.
                    </p>
                    <a href="arquivos/financeiro.php">Acompanhar financeiro</a>
                </div>

                <!-- ETAPA 8 -->
                <div class="card">

                    <div class="icone-projeto">
                        ▦
                    </div>

                    <h3>Desenvolvimento</h3>
                    <p>
                        Defina se o projeto está pendente, em desenvolvimento ou entregue.
                    </p>
                    <a href="arquivos/desenvolvimento.php">Status do projeto</a>
                </div>

                <!-- ETAPA 9 -->
                <div class="card">

                    <div class="icone-projeto">
                        ◍
                    </div>

                    <h3>Consultar status</h3>
                    <p>
                        Acompanhe a resposta da proposta, o andamento da análise e o estado atual do projeto.
                    </p>
                    <a href="arquivos/consultar-projeto.php">Consultar projeto</a>
                </div>

                </div>
            </section>

            <section id="contato" class="contato">
                <div class="titulo-secao">
                    <p>Vamos conversar?</p>
                    <h2>Contatos</h2>
                </div>
                <div class="contato-links">
                    <a href="https://wa.me/5541998892366">WhatsApp</a>
                    <a href="mailto:puxadinhodigital@gmail.com">Email</a>
                    <a href="https://github.com/HellintonL/Software-House-Project">GitHub</a>
                    <a href="">LinkedIn</a>
                </div>
            </section>
    </main>

    <footer>
        <p>
            Desenvolvido pelo <a href="https://look.devlook.xyz">Grupo APD</a>
        </p>
        <p>
            HTML + CSS + PHP + JavaScript + JSON
        </p>
    </footer>  
</body>
</html>