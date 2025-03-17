<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include_once __DIR__ . '/../../Models/LivrosModel.php';
    include_once __DIR__  . '/../../Controllers/LivrosController.php';
    

    $pdo = new PDO("mysql:host=localhost;dbname=azulibre_rede", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['id'];

    $livrosController = new DankiCode\Controllers\LivrosController();
    $livrosModel = new DankiCode\Models\LivrosModel($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['post_livro'])) {
            $termo_pesquisa = isset($_POST['termo_pesquisa']) ? $_POST['termo_pesquisa'] : null;
            $livrosController->processarFormulario($livrosModel, $termo_pesquisa);

            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        } elseif (isset($_POST['pesquisar_livros'])) {
            $termo_pesquisa = isset($_POST['termo_pesquisa']) ? $_POST['termo_pesquisa'] : null;
            $resultadosPesquisa = $livrosController->pesquisarLivros($livrosModel, $termo_pesquisa);
        }
    }

    if (isset($_GET['excluir'])) {
        $livroIdParaExcluir = $_GET['excluir'];

        $livrosModel->excluirLivro($livroIdParaExcluir, $_SESSION['id']);

        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    }

    if (isset($_GET['excluir'])) {
        $livroIdParaExcluir = $_GET['excluir'];

        $_SESSION['pagina_anterior'] = $_SERVER['REQUEST_URI'];

        $livrosModel->excluirLivro($livroIdParaExcluir, $_SESSION['id']);

        $_SESSION['livro_excluido'] = true;

        header("Location: livros.php");
        exit();
    }

    $publicacoes = $livrosModel->getAllPublicacoes();

    unset($_SESSION['form_processed']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Livros | AzuLibre</title>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <link rel="stylesheet" type="text/css" href="./DankiCode/Views/pages/estilos/modal-livros.css">
        <link rel="stylesheet" type="text/css" href="./estilos/destaqueuser.css">
        <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">
        <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/livros-feed.css" rel="stylesheet">
        <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">

        <style>
            section .body {
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #ffffff;
                overflow-x: hidden;  
            }

            #pesquisa {
                margin-bottom: 10px;
            }

            /* Estilo para a barra de pesquisa */
            .filtro-icon-container {
                position: absolute;
                left: 5px; 
                background-color: #ffd700; 
                width: 30px; 
                height: 30px; 
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                margin-right: 5px; 
            }

            .filtro-icon {
                color: black; 
            }

            .pesquisa-container {
                display: flex;
                align-items: center;
                max-width: 900px;
                margin: 0 auto;
                position: relative;
            }

            .pesquisa-container input {
                flex: 1; 
                padding: 10px;
                border: 1px solid black;
                border-radius: 15px;
                padding-left: 40px; 
                transition: width 0.3s ease;
            }

            .pesquisa-container button {
                position: absolute;
                right: 5px;
                padding: 10px;
                color: black;
                background-color: transparent;
                border: none;
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .pesquisa-container button:hover {
                color: black;
                background-color: transparent;
                transform: scale(1.2);
            }

            .pesquisa-container button i {
                color: black;
            }

            .pesquisa-container button::before {
                content: ""; 
                display: block;
                width: 25px;
                height: 25px; 
                background-color: #ffd700; 
                border-radius: 50%; 
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                z-index: -1; 
            }

            .pesquisa-container button i {
                position: relative; 
                z-index: 1; 
            }

            #abrirModal {
                display: block;
                width: 100%;
                padding: 15px;
                background-color: #22245b;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 5px;
            }

            #abrirModal:hover {
                background-color: darkblue;
            }

            #excluir-link {
                float: right;
                color: red; 
                margin-right: -230px; 
                cursor: pointer;
            }

            .livros img {
                max-width: 80%; 
                max-height: 800px; 
                object-fit: cover; 
                
            }

            .AbrirInfoModal {
                display: inline-block;
                padding: 10px 15px;
                background-color: #22245b;
                width:100%;
                text-align: center;
                margin-bottom: 10px;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .AbrirInfoModal:hover {
                background-color: #EEBD3E;
                color: #22245B;
            }

            .filtro-dropdown {
                position: absolute;
                top: 45px;
                left: 0;
                display: none;
                background-color: white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                z-index: 1;
                column-count: 5; 
                column-gap: 5px; 
                max-height: 200px; 
                overflow-y: auto; 
            }

            .filtro-dropdown a {
                display: block;
                padding: 10px;
                text-decoration: none;
                color: black;
            }

            .filtro-dropdown a:hover {
                background-color: #f2f2f2;
            }

            .avaliacoes {
            }

            .avaliacao-item {
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                transition: transform 0.3s ease-in-out;
                width: 100%;
                max-width: 400px;
            }

            .avaliacao-item:hover {
                transform: translateY(-5px);
            }

            .avaliacao-usuario {
                font-weight: bold;
                padding: 10px;
                background-color: #22245B;
                color: #fff;
                margin: 0;
                border-bottom: 1px solid #ddd;
            }

            .avaliacao-rating {
                padding: 10px;
                font-size: 24px;
                color: #f39c12; /* Cor das estrelas */
            }

            .avaliacao-mensagem {
                padding: 10px;
                margin: 0;
            }

            .estrelas {
                display: inline-block;
            }

            .estrelas input {
                display: none;
            }

            .estrelas label {
                float: right;
                padding: 0 0.1em;
                cursor: pointer;
            }

            .estrelas label:before {
                content: '\2605';
                font-size: 2em;
                color: #ddd;
            }

            .estrelas input:checked~label:before {
                color: #f90;
            }

            .estrelas:hover label:before {
                color: #ddd;
            }

            .estrelas label:hover:before {
                color: #f90;
            }
        </style>
    </head>

    <body>
        <section class="main-feed">
            <?php include('includes/sidebar.php'); ?>

            <section class="feed">
                <section class="feed-wraper-livro">
                    <section class="feed-form">

                        <h1> Procurando por alguma obra, <?php echo $_SESSION['nome']; ?>?</h1>
                        <section id="pesquisa">
                            <form method="post" enctype="multipart/form-data">
                                <section class="pesquisa-container">
                                    <section class="filtro-icon-container">
                                        <i class="fas fa-filter filtro-icon"></i>
                                        <section class="filtro-dropdown">
                                            <?php
                                            $generos = array(
                                                "Romance", "Ficção Científica", "Mistério", "Fantasia", "Ação", "Aventura", "Comédia", "Drama", "Faroeste", "Horror",
                                                "Musical", "Sci-Fi", "Suspense", "Terror", "Infantil", "Romance Policial", "Biografia", "Autoajuda", "Fantasia Científica",
                                                "História", "Policial", "Filosofia", "AutoBiografia", "Poesia", "Crônica", "Romance Historico", "Ficcao",
                                                "Terror Psicológico", "Romance Gay", "Romance Lésbico", "Comédia Romântica", "Aventura Espacial", "Literatura Nacional",
                                                "Literatura Estrangeira", "Policialesco", "Ficcao Científica Espacial", "Conto", "Ensaio", "Crítica Literária",
                                                "Romance de Época", "Romance Contemporâneo", "Romance de Suspense", "Poesia Contemporânea"
                                                // Adicione mais gêneros conforme necessário
                                            );

                                            foreach ($generos as $genero) {
                                                echo '<a href="#">' . $genero . '</a>';
                                            }
                                            ?>

                                        </section>
                                    </section>

                                    <input type="text" name="termo_pesquisa" placeholder="Pesquisar por Titulo, Autor ou Gênero">
                                    <button type="submit" name="pesquisar_livros">
                                        <i class="fas fa-search"></i>
                                    </button>

                                </section>
                            </form>
                        </section>

                        <br>
                        <h1> Compartilhe seus livros de domínio público, contribuindo para a descoberta na comunidade! </h1>
                        <button id="abrirModal">Postar livro!</button>

                        <br>
                        <section id="PublicaçaoModal" class="modal">
                            <section class="modal-content">
                                <span id="FecharModalPubli" class="close">&times;</span>
                                <h2>Publique uma obra favorita ou sua própria obra! (nacionais)</h2>
                                <form method="post" enctype="multipart/form-data">
                                    <input id="text" type="text" name="titulo" placeholder="Título" required>
                                    <label for="descricao">Descrição:</label>
                                    <textarea name="descricao" placeholder="Descrição" required></textarea>
                                    <label for="genero">Gênero:</label>
                                    <select name="genero" id="genero" required>
                                        <option value="Romance">Romance</option>
                                        <option value="Ficcao Cientifica">Ficção Científica</option>
                                        <option value="Misterio">Mistério</option>
                                        <option value="Fantasia">Fantasia</option>
                                        <option value="Acao">Ação</option>
                                        <option value="Aventura">Aventura!</option>
                                        <option value="Comedia">Comédia</option>
                                        <option value="Drama">Drama</option>
                                        <option value="Faroeste">Faroeste</option>
                                        <option value="Horror">Horror</option>
                                        <option value="Musical">Musical</option>
                                        <option value="Sci-Fi">Sci-Fi</option>
                                        <option value="Suspense">Suspense</option>
                                        <option value="Terror">Terror</option>
                                        <option value="Infantil">Infantil</option>
                                        <option value="Romance Policial">Romance Policial</option>
                                        <option value="Biografia">Biografia</option>
                                        <option value="Autoajuda">Autoajuda</option>
                                        <option value="Fantasia Científica">Fantasia Científica</option>
                                        <option value="História">História</option>
                                        <option value="Policial">Policial</option>
                                        <option value="Filosofia">Filosofia</option>
                                        <option value="Autoajuda">Autoajuda</option>
                                        <option value="AutoBiografia">AutoBiografia</option>
                                        <option value="Poesia">Poesia</option>
                                        <option value="Crônica">Crônica</option>
                                        <option value="Romance Historico">Romance Histórico</option>
                                        <option value="Ficcao">Ficção</option>
                                        <option value="Terror Psicológico">Terror Psicológico</option>
                                        <option value="Romance Gay">Romance Gay</option>
                                        <option value="Romance Lésbico">Romance Lésbico</option>
                                        <option value="Comédia Romântica">Comédia Romântica</option>
                                        <option value="Aventura Espacial">Aventura Espacial</option>
                                        <option value="Literatura Nacional">Literatura Nacional</option>
                                        <option value="Literatura Estrangeira">Literatura Estrangeira</option>
                                        <option value="Policialesco">Policialesco</option>
                                        <option value="Ficcao Científica Espacial">Ficção Científica Espacial</option>
                                        <option value="Conto">Conto</option>
                                        <option value="Ensaio">Ensaio</option>
                                        <option value="Crítica Literária">Crítica Literária</option>
                                        <option value="Romance de Época">Romance de Época</option>
                                        <option value="Romance Contemporâneo">Romance Contemporâneo</option>
                                        <option value="Romance de Suspense">Romance de Suspense</option>
                                        <option value="Poesia Contemporânea">Poesia Contemporânea</option>
                                        <!-- Adicionar mais gêneros aqui -->
                                    </select>

                                    <section class="file-upload-pdf">
                                        <input id="file" class="inputfile-pdf" type="file" name="pdfFile" accept=".pdf" required>
                                        <label for="file">
                                            <i class="fa-solid fa-file-pdf" style="color: #ffffff;"></i> Inserir PDF
                                        </label> 
                                    </section>
                                
                                    <section class="file-upload-capa">
                                        <input accept=".jpg, .png, .jpeg" type="file" name="capaFile" id="file-capa" class="inputfile-capa" required>
                                        <label for="file-capa"> <!-- Corrigido para "file-capa" A -->
                                            <i class="fa-solid fa-panorama" style="color: #ffffff;"></i>Adicionar capa do livro
                                        </label> 
                                    </section>

                                    <input type="submit" name="post_livro" value="Postar Livro">
                                </form>
                            </section>
                        </section>

                        <section id="infoModal" class="modal">
                            <section class="modal-content">
                                <span id="FecharModalInfo" class="close">&times;</span>
                                <h2 id="info-titulo"></h2>
                                <p id="info-descricao"></p>
                                <p id="info-genero"></p>
                                <a href="#" id="AbrirPdf-Modal">Abrir PDF</a>
                            </section>
                        </section>

                        <section id="pdfModal" class="modal">
                            <section class="modal-content">
                                <span id="FecharModalPdf" class="close">&times;</span>
                                <iframe id="pdfViewer" width="100%" height="500" frameborder="0"></iframe>
                            </section>
                        </section>

                        <section id="alertaModal" class="modal">
                            <section class="modal-content">
                                <span id="fecharAlerta" class="close">&times;</span>
                                <h2>Livro Publicado</h2>
                                <p>Seu livro foi publicado com sucesso!</p>
                            </section>
                        </section>
                        <br>
                        
                        <section class="feed-single-post-user">
                            <?php
                                if (!empty($resultadosPesquisa)) {
                                    $publicacoesExibidas = $resultadosPesquisa;
                                } else {
                                    $publicacoesExibidas = $publicacoes;
                                }

                                usort($publicacoesExibidas, function ($a, $b) {
                                    return strtotime($b['data_hora']) - strtotime($a['data_hora']);
                                });

                                foreach ($publicacoesExibidas as $publicacao) {
                                    exibirPublicacaoLivro($publicacao);
      
                                    $avaliacoes = buscarAvaliacoes($publicacao['id']);
                                    echo '<section class="avaliacoes">';
                                    foreach ($avaliacoes as $avaliacao) {
                                        echo '<div class="avaliacao-item">';
                                        echo '<p class="avaliacao-usuario"><strong>Usuário:</strong> ' . buscarNomeUsuario($avaliacao['id_usuario']) . '</p>';
                                        echo '<div class="avaliacao-rating">';
                                        echo '<p class="avaliacao-estrelas">' . str_repeat('&#9733;', $avaliacao['qtd_estrela']) . '</p>';
                                        echo '</div>';
                                        echo '<p class="avaliacao-mensagem">' . $avaliacao['mensagem'] . '</p>';
                                        echo '</div>';
                                    }
                                    echo '</section>';
                                    echo '<section class="container-form-avaliacao">';
                                    echo '<h2 class="titulo-form-avaliacao">Avalie este Livro</h2>';
                                    echo '<form method="post" action="">';
                                    echo '<section class="estrelas">';
                                    echo '<legend class="label-avaliacao"><b>Avaliação:</b></legend>';
                                    echo '<input type="radio" id="star5_' . $publicacao['id'] . '" name="qtd_estrela" value="5" /><label for="star5_' . $publicacao['id'] . '" title="Excelente"></label>';
                                    echo '<input type="radio" id="star4_' . $publicacao['id'] . '" name="qtd_estrela" value="4" /><label for="star4_' . $publicacao['id'] . '" title="Muito Bom"></label>';
                                    echo '<input type="radio" id="star3_' . $publicacao['id'] . '" name="qtd_estrela" value="3" /><label for="star3_' . $publicacao['id'] . '" title="Bom"></label>';
                                    echo '<input type="radio" id="star2_' . $publicacao['id'] . '" name="qtd_estrela" value="2" /><label for="star2_' . $publicacao['id'] . '" title="Regular"></label>';
                                    echo '<input type="radio" id="star1_' . $publicacao['id'] . '" name="qtd_estrela" value="1" /><label for="star1_' . $publicacao['id'] . '" title="Ruim"></label>';
                                    echo '</section><br>';
                                    echo '<label class="label-avaliacao"><b>Comentário:</b></label>';
                                    echo '<textarea name="mensagem" placeholder="Digite seu comentário"></textarea>';
                                    echo '<input type="submit" name="submit_avaliacao" value="Avaliar">';
                                    echo '<input type="hidden" name="id_livro" value="' . $publicacao['id'] . '">';
                                    echo '</form>';
                                    echo '</section>';
                                    echo '</section>';
                                }
                                
                            ?>
                        </section>

                        <?php

                            $pdo = new PDO("mysql:host=localhost;dbname=azulibre_rede", "root", "");
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            function exibirPublicacaoLivro($publicacao)
                            {
                                echo '<section class="catalogo-livros">';
                                echo '<section class="feed-single-post">';
                                echo '<section class="livros">';

                                echo '<section class="feed-single-post-author">';
                                echo '<section class="img-single-post-author">';

                                echo '<section class="excluir-link">';
                                if ($_SESSION['id'] == $publicacao['usuario_id']) {
                                    echo '<a id="excluir-link" href="?excluir=' . $publicacao['id'] . '"><i class="fas fa-trash-alt"></i></a>';
                                }
                                
                                echo '</section>';

                                $fotoUsuario = $publicacao['img_usuario']; 

                                if (!empty($fotoUsuario)) {
                                    echo '<img src="' . INCLUDE_PATH . 'uploads/' . $fotoUsuario . '" />';
                                } else {
                                    echo '<img src="' . INCLUDE_PATH_STATIC . 'images/avatar.jpeg" />';
                                }

                                echo '</section>';
                                echo '<section class="feed-single-post-author-info">';
                                echo '<h3>' . $publicacao['nome_usuario'] . '</h3>'; // Agora usa o nome do autor da publicação
                                echo '<p>' . date('d/m/Y H:i:s', strtotime($publicacao['data_hora'])) . '</p>';


                                echo '</section>';
                                echo '</section>';

                                // Outras informações da publicação
                                echo '<h2>' . $publicacao['titulo'] . '</h2>';
                                echo '<section class="container-img-livro"><img src="' . $publicacao['capa_path'] . '" alt="Capa da Publicação"></section>';
                                echo '<a href="#" class="AbrirInfoModal" data-titulo="' . $publicacao['titulo'] . '" data-descricao="' . $publicacao['descricao'] . '" data-genero="' . $publicacao['genero'] . '" data-pdf="' . $publicacao['pdf_path'] . '">Detalhes</a>';

                                echo '</section>';
                                echo '</section>';
                                $avaliacoes = buscarAvaliacoes($publicacao['id']);

                            }

                            function buscarAvaliacoes($idLivro)
                            {
                                $pdo = new PDO("mysql:host=localhost;dbname=azulibre_rede", "root", "");
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $stmt = $pdo->prepare("SELECT * FROM avaliacao WHERE id_livro = ?");
                                $stmt->execute([$idLivro]);
                                
                                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                            }

                            // Função para buscar nome do usuário pelo id_usuario
                            function buscarNomeUsuario($idUsuario)
                            {
                                $pdo = new PDO("mysql:host=localhost;dbname=azulibre_rede", "root", "");
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id = ?");
                                $stmt->execute([$idUsuario]);

                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                                return $resultado['nome'];
                            }
                            ?>

                            <?php

                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_avaliacao'])) {
                                    $pdo = new PDO("mysql:host=localhost;dbname=azulibre_rede", "root", "");
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $id_livro = $_POST['id_livro'];
                                    $qtd_estrela = $_POST['qtd_estrela'];

                                    $mensagem = $_POST['mensagem'];
                                    $id_usuario = $_SESSION['id'];

                                    $stmt = $pdo->prepare("INSERT INTO avaliacao (qtd_estrela, mensagem, id_livro, id_usuario) VALUES (?, ?, ?, ?)");
                                    $stmt->execute([$qtd_estrela, $mensagem, $id_livro, $id_usuario]);

                                    echo '<script>window.location.href = "' . $_SERVER['REQUEST_URI'] . '";</script>';
                                    exit();
                                }


                            ?>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelector('.filtro-icon-container').addEventListener('click', function () {
                    var dropdown = document.querySelector('.filtro-dropdown');
                    
                    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
                });

                document.querySelectorAll('.filtro-dropdown a').forEach(function (item) {
                    item.addEventListener('click', function () {
                        document.querySelector('input[name="termo_pesquisa"]').value = this.innerText;

                        document.querySelector('.filtro-dropdown').style.display = 'none';
                    });
                });

                document.addEventListener('click', function (event) {
                    var dropdown = document.querySelector('.filtro-dropdown');
                    if (event.target.closest('.filtro-icon-container') === null && event.target.closest('.filtro-dropdown') === null) {
                        dropdown.style.display = 'none';
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                function validarFormulario() {
                    var pdfFile = document.getElementById('pdfFile');
                    var capaFile = document.getElementById('capaFile');

                    if (!pdfFile.files.length || !capaFile.files.length) {
                        alert("Por favor, envie tanto o PDF quanto a foto de capa.");
                        return false;
                    }

                    return true;
                }

                document.getElementById('formularioLivro').addEventListener('submit', function(event) {
                    if (!validarFormulario()) {
                        event.preventDefault();
                    }
                });
            });
            
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#abrirModal').click(function() {
                    $("#PublicaçaoModal").show();
                });

                $('#FecharModalPubli').click(function() {
                    $("#PublicaçaoModal").hide();
                });

                $('.AbrirInfoModal').click(function(e) {
                    e.preventDefault();
                    var infoModal = $("#infoModal");
                    var titulo = $(this).data('titulo');
                    var descricao = $(this).data('descricao');
                    var genero = $(this).data('genero');
                    var pdfPath = $(this).data('pdf');
                    $('#info-titulo').text(titulo);
                    $('#info-descricao').text("Sinopse: " + descricao);
                    $('#info-genero').text("Gênero: " + genero);
                    $('#AbrirPdf-Modal').data('pdf', pdfPath);
                    infoModal.show();
                });

                $('#AbrirPdf-Modal').click(function(e) {
                    e.preventDefault();
                    var pdfPath = $(this).data('pdf');
                    $('#pdfViewer').attr('src', pdfPath);
                    $("#pdfModal").show();
                    $("#infoModal").hide();
                });

                $('#FecharModalInfo').click(function() {
                    $("#infoModal").hide();
                });

                $('#FecharModalPdf').click(function() {
                    $("#pdfModal").hide();
                });

                $(window).click(function(event) {
                    var PublicaçaoModal = $("#PublicaçaoModal");
                    var infoModal = $("#infoModal");
                    var pdfModal = $("#pdfModal");
                    if (event.target == PublicaçaoModal[0]) {
                        PublicaçaoModal.hide();
                    }
                    if (event.target == infoModal[0]) {
                        infoModal.hide();
                    }
                    if (event.target == pdfModal[0]) {
                        pdfModal.hide();
                    }
                });
            });
        </script>



    </body>
</html>