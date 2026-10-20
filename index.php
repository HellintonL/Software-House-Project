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
            <a href="#projetos">Apresentar projeto</a>
            <a href="#contato">Contato</a>
            <a href="arquivos/cadastro.php">Cadastro</a>
            <a href="arquivos/orcamento.php">Orçamento</a>
        </nav>
    </header>
    
    <main>
           <section id="inicio" class="inicio">
            <div class="inicio-conteudo">
                <p class="apresentacao">Olá, somos empresa</p>
                <h1>APD</h1>
                <h2>Desenvolvedores de software</h2>
                <p class="descricao">
                Nossa empresa é especializada na execução de projetos personalizados, transformando as ideias de nossos clientes em realidade. Trabalhamos com compromisso, qualidade e eficiência, buscando sempre atender às necessidades e expectativas de cada cliente.
                </p>
            </div>

            <div class="botoes">
                <a href="#projetos" class="botao">Mostrar projeto </a>
                <a href="#contato" class="botao botao-secundario">Entrar em contato</a>
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

                <!-- PROJETO 1-->

                <div class="card">

                    <div class="icone-projeto">
                        ◇
                    </div>

                    <h3>Apresentar projeto</h3>
                    <p>
                        Conte-nos sobre seu projeto, seus objetivos e o que você deseja construir. Vamos analisar sua ideia e preparar uma proposta personalizada para você.
                    </p>

                    
                    <a href="arquivos/software-house.php">Apresentar projeto</a>
                </div>

                <!-- PROJETO 2-->

                <div class="card">

                    <div class="icone-projeto">
                        R$
                    </div>

                    <h3>Ver orçamento</h3>
                    <p>
                        Analisamos sua proposta com atenção para elaborar um orçamento, com valores e prazos de acordo com as necessidades do seu projeto. 
                    </p>
                    <a href="atividades/idade.php">Ver orçamento e prazo</a>
                </div>

                <!-- PROJETO 3-->
                <div class="card">

                    <div class="icone-projeto">
                        ▦
                    </div>

                    <h3>Ver empresas</h3>
                    <p>
                        Aqui você pode ver as empresas que já apresentaram seus projetos, com informações sobre cada uma delas, como nome, contato e status do projeto.
                    </p>
                    <a href="arquivos/dados-json.php">Ver empresas</a>

                </div>

                <!-- PROJETO 4-->
                <div class="card">

                    <div class="icone-projeto">
                        ♙
                    </div>

                    <h3>Cadastro</h3>
                    <p>
                         Cadastre-se para conhecer e acompanhar os serviços da Software Home.
                    </p>
                    <a href="arquivos/cadastro.php">Acessar cadastro</a>
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
                    <a href="mailto:kauacastroamaral@gmail.com">Email</a>
                    <a href="https://github.com/kauacastroamaral-prog">GitHub</a>
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