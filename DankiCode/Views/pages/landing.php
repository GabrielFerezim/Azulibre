<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">
        <title>AzuLibre | Leitura Nacional</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /*Cabeçalho*/
            .cabecalho{
                height: 13vh;
                display: flex;
            }

            .menu{
                padding-left: 65%;
                padding-top: 2%;
            }

            .hiperlink-cadastrar,.hiperlink-entrar{
                text-decoration: none;
                color: #FFFF;
                font-family: 'Montserrat', sans-serif;
                font-size: 17px;
            }

            .btn-cadastrar,.btn-entrar{
                border: none;
                border-radius: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .btn-cadastrar{
                background-color: #22245B;
                color: #FFFF;
                margin-right: 25px;
            }

            .btn-entrar{
                background-color: #EEBD3E;
                color: #FFFF;
            }
            /*Fim Cabeçalho*/

            /*Main*/
            .conteudo{
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logo-azulibre{
                width: 550px;
                height: 550px;
            }

            .figure-logo-azulibre{
                margin-left: 100px;
            }

            .conteudo-left{
                width: 50vw;
                z-index: 1;
            }

            .conteudo-right{
                width: 50vw;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .btn-explorar{
                background-color: #EEBD3E;
                border: none;
                border-radius: 30px;
                box-shadow: 4px 3px #22245B;
                margin-top: 20px;
                padding: 10px;

            }

            .explorar{
                text-decoration: none;
                color: #FFFF;
                font-family: 'Montserrat', sans-serif;
            }

            .redes-sociais{
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                margin-top: 450px;
                margin-right: -240px;

            }

            .img-redes-sociais{
                width: 60px;
                height: 60px;
                padding: 5px;
            }

            .circle{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #DEDEE5;
                clip-path: circle(700px at left 880px);
            }
            .nome-azulibre{
                font-family: 'Montserrat', sans-serif;
                color: #EEBD3E;
                margin-top: 25px;
                margin-left: 50px;
            }

            .nome-azulibre-azul{
                color: #22245B ;
            }

            .title-conteudo{
                font-size: 45px;
                font-family: 'Montserrat', sans-serif;
                color: #22245B;
                padding-bottom: 35px;
            }

            .bem-vindo{
                color: #EEBD3E;
            }

            .text-conteudo{
                font-size: 25px;
                font-family: 'Montserrat', sans-serif;
                color:#22245B;
                text-align: center;
            }

            .text-redes-sociais{
                font-size: 20px;
                font-family: 'Montserrat', sans-serif;
                color: #22245B;
            }
            .informacoes-adicionais {
                margin-top: 120px; 
                text-align: left;
                padding: 20px; 
                background-color: #F5F5F5; 
                border-radius: 15px; 
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            }

            .informacoes-adicionais p {
                font-family: 'Montserrat', sans-serif;
                font-size: 18px;
                line-height: 1.6;
                color: #EEBD3E; 
                max-width: 1000px; 
                margin: 0 auto;
                margin-bottom: 20px;
            }

            .informacoes-adicionais h1 {
                text-align: center;
                font-family: 'Montserrat', sans-serif;
                font-size: 40px; 
                color: #22245b; 
                margin-bottom: 20px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); 
            }


            .informacoes-adicionais .destaque {
                font-size: 20px;
                color: #22245B;
                margin-top: 15px;
                margin-bottom: 10px;
                font-weight: lighter;
            }

            #background {
                margin: 0 auto;
                height: 200px;
                width: 1020px;
                border-radius: 20px;
                background-color: #EEBD3E;
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin-bottom: 10px;
            }

                .rodape {
                text-align: center;
                padding: 20px;
                background-color: #22245B;
                color: #FFFF;
                font-family: 'Montserrat', sans-serif;
            }

        </style>
    </head>
    <body class="corpo">
        <header class="cabecalho">
            <h1 class="nome-azulibre"><span class="nome-azulibre-azul">Azu</span>Libre</h1>
            <section class="menu">
                <button class="btn-cadastrar">
                    <a class="hiperlink-cadastrar" href="<?php echo INCLUDE_PATH ?>registrar"><b>Cadastrar</b></a>
                </button>

                <button class="btn-entrar">
                    <a class="hiperlink-entrar" href="<?php echo INCLUDE_PATH ?>registrar"><b>Entrar</b></a>
                </button>
            </section>
        </header>    

        <main class="conteudo">
            <section class="circle"></section>

            <section class="conteudo-left">
                <figure class="figure-logo-azulibre">
                    <img class="logo-azulibre" src="<?php echo INCLUDE_PATH_STATIC ?>images/AzuLibreColorida.svg"/>
                </figure>
            </section>

            <section class="conteudo-right">
                <h2 class="title-conteudo">Bem-Vindo<span class="bem-vindo">(a)</span></h2>

                <p class="text-conteudo">
                    Se você é um escritor em busca<br> de um público ou um amante da<br> literatura nacional.<br>
                    A AzuLibre é o seu lugar!
                </p>

                <button class="btn-explorar">
                    <a class="explorar" href="<?php echo INCLUDE_PATH ?>registrar"><b>Comece a explorar agora!</b></a>
                </button>

                <section class="redes-sociais">
                    <p class="text-redes-sociais"><b>Siga-nos nas redes sociais:</b></p>
                    <a target="_blank" href="https://www.instagram.com/azulibre_oficial/">
                        <img class="img-redes-sociais" src="<?php echo INCLUDE_PATH_STATIC ?>images/instagram.png" title="Instagram"/>
                    </a>

                    <a target="_blank" href="https://www.tiktok.com/@azulibre?_t=8hMKvCcyER4&_r=1">
                        <img class="img-redes-sociais" src="<?php echo INCLUDE_PATH_STATIC ?>images/tiktok.png" title="Tiktok"/>
                    </a>
                </section>
            </section>
            
        </main>
        <section class="informacoes-adicionais">
            <h1 class="h1">Faça parte da AzuLibre!</h1>

            <section id="background">
                <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Publicar seu livro na AzuLibre é simples! Basta criar uma conta, acessar a seção de publicação e seguir os passos <b>intuitivos</b>. Adicione detalhes do seu livro, como título, sinopse e capa, e pronto! Nossa plataforma foi projetada para tornar o processo de publicação <b>fácil e acessível</b>.</p>
            </section>

            <br><br>
            <h1 class="h1">"Posso publicar meus próprios livros?"</h1>
                
            <section id="background"> 
                <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sim, você pode publicar livros de autoria própria na AzuLibre! Estamos comprometidos em fornecer um espaço acolhedor para escritores independentes compartilharem suas histórias com a comunidade. Seja você um autor <b>iniciante ou experiente</b>, todos são bem-vindos a contribuir para a diversidade literária em nossa plataforma.</p>
            </section>

            <br><br>
            <h1 class="h1">"A AzuLibre apoia a divulgação de obras de domínio público?"</h1>
               
            <section id="background">
                 <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Na AzuLibre, incentivamos a disseminação da literatura de <b>domínio público</b>. Você pode publicar obras clássicas e outras obras que estão no domínio público, contribuindo para a preservação e acesso a essas preciosidades literárias. Certifique-se de verificar a elegibilidade do livro antes de publicar.</p>
            </section>

            <section id="background">
                <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Para garantir a qualidade e conformidade com nossos padrões, é importante que os livros publicados estejam de acordo com <b>nossos requisitos</b>. No caso de obras de domínio público, verifique se a obra atende aos critérios estabelecidos para garantir uma experiência positiva para todos os membros da comunidade AzuLibre.</p>
            </section>

            <br><br>
            <h1 class="h1">Faça parte da comunidade!</h1>
        
            <section id="background">
                 <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Além de publicar livros, convidamos você a se envolver com a <b>comunidade</b> AzuLibre. Compartilhe suas experiências, descubra novas obras e conecte-se com outros amantes da literatura nacional. Juntos, podemos construir uma plataforma vibrante e enriquecedora para todos os apaixonados por livros.</p>
            </section>

        </section>
        <br>
        <footer class="rodape">
            <p>&copy; 2023 AzuLibre. Todos os direitos reservados.</p>
        </footer>

    </body>
=======
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">
        <title>AzuLibre | Leitura Nacional</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /*Cabeçalho*/
            .cabecalho{
                height: 13vh;
                display: flex;
            }

            .menu{
                padding-left: 65%;
                padding-top: 2%;
            }

            .hiperlink-cadastrar,.hiperlink-entrar{
                text-decoration: none;
                color: #FFFF;
                font-family: 'Montserrat', sans-serif;
                font-size: 17px;
            }

            .btn-cadastrar,.btn-entrar{
                border: none;
                border-radius: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .btn-cadastrar{
                background-color: #22245B;
                color: #FFFF;
                margin-right: 25px;
            }

            .btn-entrar{
                background-color: #EEBD3E;
                color: #FFFF;
            }
            /*Fim Cabeçalho*/

            /*Main*/
            .conteudo{
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logo-azulibre{
                width: 550px;
                height: 550px;
            }

            .figure-logo-azulibre{
                margin-left: 100px;
            }

            .conteudo-left{
                width: 50vw;
                z-index: 1;
            }

            .conteudo-right{
                width: 50vw;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .btn-explorar{
                background-color: #EEBD3E;
                border: none;
                border-radius: 30px;
                box-shadow: 4px 3px #22245B;
                margin-top: 20px;
                padding: 10px;

            }

            .explorar{
                text-decoration: none;
                color: #FFFF;
                font-family: 'Montserrat', sans-serif;
            }

            .redes-sociais{
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                margin-top: 450px;
                margin-right: -240px;

            }

            .img-redes-sociais{
                width: 60px;
                height: 60px;
                padding: 5px;
            }

            .circle{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #DEDEE5;
                clip-path: circle(700px at left 880px);
            }
            .nome-azulibre{
                font-family: 'Montserrat', sans-serif;
                color: #EEBD3E;
                margin-top: 25px;
                margin-left: 50px;
            }

            .nome-azulibre-azul{
                color: #22245B ;
            }

            .title-conteudo{
                font-size: 45px;
                font-family: 'Montserrat', sans-serif;
                color: #22245B;
                padding-bottom: 35px;
            }

            .bem-vindo{
                color: #EEBD3E;
            }

            .text-conteudo{
                font-size: 25px;
                font-family: 'Montserrat', sans-serif;
                color:#22245B;
                text-align: center;
            }

            .text-redes-sociais{
                font-size: 20px;
                font-family: 'Montserrat', sans-serif;
                color: #22245B;
            }
            .informacoes-adicionais {
                margin-top: 120px; /* Reduzi a margem superior para melhorar o espaçamento */
                text-align: left; /* Ajusta o alinhamento do texto para a esquerda */
                padding: 20px; /* Adicionei um preenchimento para melhorar a legibilidade */
                background-color: #F5F5F5; /* Adicionei uma cor de fundo mais clara */
                border-radius: 15px; /* Adicionei bordas arredondadas para suavizar as extremidades */
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adicionei uma sombra suave */
            }

                .informacoes-adicionais p {
                    font-family: 'Montserrat', sans-serif;
                    font-size: 18px;
                    line-height: 1.6;
                    color: #EEBD3E; /* Ajustei a cor do texto para melhor contraste */
                    max-width: 1000px; /* Reduzi a largura máxima para melhor legibilidade */
                    margin: 0 auto;
                    margin-bottom: 20px;
                }

                .informacoes-adicionais h1 {
                text-align: center;
                font-family: 'Montserrat', sans-serif;
                font-size: 40px; /* Tamanho maior */
                color: #22245b; /* Cor mais vívida, amarelo */
                margin-bottom: 20px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Adição de sombra */
            }


                .informacoes-adicionais .destaque {
                    font-size: 20px;
                    color: #22245B;
                    margin-top: 15px;
                    margin-bottom: 10px;
                    font-weight: lighter;
                }

                #background {
                    margin: 0 auto;
                    height: 200px;
                    width: 1020px;
                    border-radius: 20px;
                    background-color: #EEBD3E;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    margin-bottom: 10px;
                }

                .rodape {
                text-align: center;
                padding: 20px;
                background-color: #22245B;
                color: #FFFF;
                font-family: 'Montserrat', sans-serif;
            }

        </style>
    </head>
    <body class="corpo">
        <header class="cabecalho">
            <h1 class="nome-azulibre"><span class="nome-azulibre-azul">Azu</span>Libre</h1>
            <section class="menu">
                <button class="btn-cadastrar">
                    <a class="hiperlink-cadastrar" href="<?php echo INCLUDE_PATH ?>registrar"><b>Cadastrar</b></a>
                </button>

                <button class="btn-entrar">
                    <a class="hiperlink-entrar" href="<?php echo INCLUDE_PATH ?>registrar"><b>Entrar</b></a>
                </button>
            </section>
        </header>    

        <main class="conteudo">
            <section class="circle"></section>

            <section class="conteudo-left">
                <figure class="figure-logo-azulibre">
                    <img class="logo-azulibre" src="<?php echo INCLUDE_PATH_STATIC ?>images/AzuLibreColorida.svg"/>
                </figure>
            </section>

            <section class="conteudo-right">
                <h2 class="title-conteudo">Bem-Vindo<span class="bem-vindo">(a)</span></h2>

                <p class="text-conteudo">
                    Se você é um escritor em busca<br> de um público ou um amante da<br> literatura nacional.<br>
                    A AzuLibre é o seu lugar!
                </p>

                <button class="btn-explorar">
                    <a class="explorar" href="<?php echo INCLUDE_PATH ?>registrar"><b>Comece a explorar agora!</b></a>
                </button>

                <section class="redes-sociais">
                    <p class="text-redes-sociais"><b>Siga-nos nas redes sociais:</b></p>
                    <a target="_blank" href="https://www.instagram.com/azulibre_oficial/">
                        <img class="img-redes-sociais" src="<?php echo INCLUDE_PATH_STATIC ?>images/instagram.png" title="Instagram"/>
                    </a>

                    <a target="_blank" href="https://www.tiktok.com/@azulibre?_t=8hMKvCcyER4&_r=1">
                        <img class="img-redes-sociais" src="<?php echo INCLUDE_PATH_STATIC ?>images/tiktok.png" title="Tiktok"/>
                    </a>
                </section>
            </section>
            
        </main>
        <section class="informacoes-adicionais">
            <h1 class="h1">Faça parte da AzuLibre!</h1>

            <section id="background">
                <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Publicar seu livro na AzuLibre é simples! Basta criar uma conta, acessar a seção de publicação e seguir os passos <b>intuitivos</b>. Adicione detalhes do seu livro, como título, sinopse e capa, e pronto! Nossa plataforma foi projetada para tornar o processo de publicação <b>fácil e acessível</b>.</p>
            </section>

            <br><br>
            <h1 class="h1">"Posso publicar meus próprios livros?"</h1>
                
            <section id="background"> 
                <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sim, você pode publicar livros de autoria própria na AzuLibre! Estamos comprometidos em fornecer um espaço acolhedor para escritores independentes compartilharem suas histórias com a comunidade. Seja você um autor <b>iniciante ou experiente</b>, todos são bem-vindos a contribuir para a diversidade literária em nossa plataforma.</p>
            </section>

            <br><br>
            <h1 class="h1">"A AzuLibre apoia a divulgação de obras de domínio público?"</h1>
               
            <section id="background">
                 <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Na AzuLibre, incentivamos a disseminação da literatura de <b>domínio público</b>. Você pode publicar obras clássicas e outras obras que estão no domínio público, contribuindo para a preservação e acesso a essas preciosidades literárias. Certifique-se de verificar a elegibilidade do livro antes de publicar.</p>
            </section>

            <section id="background">
                <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Para garantir a qualidade e conformidade com nossos padrões, é importante que os livros publicados estejam de acordo com <b>nossos requisitos</b>. No caso de obras de domínio público, verifique se a obra atende aos critérios estabelecidos para garantir uma experiência positiva para todos os membros da comunidade AzuLibre.</p>
            </section>

            <br><br>
            <h1 class="h1">Faça parte da comunidade!</h1>
        
            <section id="background">
                 <p class="destaque">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Além de publicar livros, convidamos você a se envolver com a <b>comunidade</b> AzuLibre. Compartilhe suas experiências, descubra novas obras e conecte-se com outros amantes da literatura nacional. Juntos, podemos construir uma plataforma vibrante e enriquecedora para todos os apaixonados por livros.</p>
            </section>

        </section>
        <br>
        <footer class="rodape">
            <p>&copy; 2023 AzuLibre. Todos os direitos reservados.</p>
        </footer>

    </body>
>>>>>>> a1bfbc687f9f2a566a53efe25c462d9df81d45a9
</html>