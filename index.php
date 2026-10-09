<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APD</title>
    <link rel="stylesheet" href="empresa.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
        <div class="logo">            
            <h2>Grupo <span>APD</span></h2>
        </div>

        <nav>
            <a href="#inicio">Início</a>
            <a href="#sobre">Sobre a empresa</a>
            <a href="#projetos">Apresentar projeto</a>
            <a href="#contato">Contato</a>
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
                    </div>
                </div>
            </section>

            <section id="projetos" class="projetos-secao">
                <div class="projetos">

                <div class="card">

                    <div class="numero-projeto">
                        01
                    </div>

                    <h3>Apresentar projeto</h3>
                    <p>
                        Descreva seu projeto, iremos fazer a análise da solicitação de projeto e retornamos com confimação e o orçamento.
                    </p>

                    <div class="tecnologias">
                        <span>PHP</span>
                        <span>HTML</span>
                        <span>CSS</span>
                    </div>
                    <a href="teste.html">Ver projetos</a>
                </div>

                <!-- PROJETO 2-->

                <div class="card">

                    <div class="numero-projeto">
                        02
                    </div>

                    <h3>Sistema de verificação de idade - GET</h3>
                    <p>
                        Recebe idade e informa se é maior ou menor de idade em GET
                    </p>

                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="atividades/idade.php">Ver projetos</a>
                </div>


                    <!--PROJETO 3  -->
                    <!--div class="card">
                        <div class="numero-projeto">
                            03
                        </div>
                        <h3>Sistema de cadastro</h3>
                        <p>Descrição do sistema de cadastro</p>
                        <div class="tecnologias">
                            <span>HTML</span>
                            <span>CSS</span>
                            < span>PHP</span -->
                        <!--/div>
                        <a href="/helpdesk.php">Ver projeto</a>
                    </div-->
                </div>
            </section>

            <section id="contato" class="contato">
                <div class="titulo-secao">
                    <p>Vamos conversar?</p>
                    <h2>Contato</h2>
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
            Desenvolvido por <a href="https://look.devlook.xyz">Kauã Castro</a>
        </p>
        <p>
            HTML + CSS
        </p>
    </footer>  
</body>
</html>