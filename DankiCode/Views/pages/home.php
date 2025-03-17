<?php
    if (session_status() == PHP_SESSION_NONE) {
        // Se a sessão não foi iniciada, inicie-a
        session_start();
    }

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.gooogleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">

        <link rel="stylesheet" type="text/css" href="./estilos/style.css">
        <link rel="stylesheet" type="text/css" href="./estilos/reset.css">
        <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <section class="main-feed">
            <?php
            include('includes/sidebar.php');
            ?>
            <section class="feed">
                <section class="feed-wraper">

                <h1 class="saudacao" id="saudacao"></h1>

                    <section class="feed-form">
                        <form method="post" enctype="multipart/form-data">
                            <textarea name="post_content" placeholder="No que você está pensando?" required></textarea>
                            <section class="button-container">
                                <section class="file-upload">
                                    <input type="file" name="post_image[]" id="file" accept=".jpg, .png, .jpeg" class="inputfile" multiple />
                                    <label for="file">
                                        <i class="fas fa-upload"></i> Anexar imagem
                                    </label>
                                </section>

                                <input type="hidden" name="post_feed">
                                <input type="submit" name="acao" value="Postar!">
                            </section>
                        </form>
                    </section>

                    <?php

                    $retrivePosts = \DankiCode\Models\HomeModel::retrieveFriendsPosts();

                    foreach ($retrivePosts as $key => $value) {

                        if (!empty($value['conteudo'])) {

                    ?>

                            <section class="feed-single-post">
                                <section class="feed-single-post-author">

                                    <section class="img-single-post-author">
                                        <?php
                                        if (empty($value['img'])) {
                                        ?>
                                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpeg" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img'] ?>" />
                                        <?php
                                        }
                                        ?>
                                    </section>


                                    <section class="feed-single-post-author-info">
                                        <?php if ($value['me']) { ?>
                                            <h3><?php echo $_SESSION['nome']; ?> (eu)</h3>
                                        <?php } else { ?>
                                            <h3><?php echo $value['usuario']; ?></h3>
                                        <?php } ?>
                                        <p><?php echo date('d/m/Y H:i:s', strtotime($value['date'])); ?></p>

                                    </section>
                                </section>

                                <section class="feed-single-post-content image-gallery">
                                    <?php
                                    echo $value['conteudo'];
                                    ?>

                                </section>

                                <div class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content">
                                    <span class="prev">❮</span>
                                    <span class="next">❯</span>
                                </div>
                            </section>

                    <?php
                        }
                    }
                    ?>

                </section>

                <section class="friends-request-feed">
                    <h4>Solicitações de amizade&nbsp;&nbsp;<i class="fa-solid fa-bell"></i></h4>
                    <?php
                    $amizadesPendentes = \DankiCode\Models\UsuariosModel::listarAmizadesPendentes();
                    ?>

                    <?php
                    if (empty($amizadesPendentes)) {
                        echo '<p class="no-friend-requests">Você não possui nenhuma solicitação!</p>';
                    } else {
                        foreach ($amizadesPendentes as $key => $value) {
                            $usuarioInfo = \DankiCode\Models\UsuariosModel::getUsuarioById($value['enviou']);
                            $imagemUsuario = !empty($usuarioInfo['img']) ? INCLUDE_PATH . 'uploads/' . $usuarioInfo['img'] : INCLUDE_PATH_STATIC . 'images/avatar.jpeg';
                    ?>

                            <section class="friends-request-single">
                                <img src="<?php echo $imagemUsuario; ?>" />
                                <section class="friends-request-single-info">
                                    <h3><?php echo $usuarioInfo['nome']; ?></h3>
                                    <a class="aceitar" href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $usuarioInfo['id']; ?>">Aceitar</a> | <a class="recusar" href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $usuarioInfo['id']; ?>">Recusar</a>
                                </section>
                            </section>

                    <?php
                        }
                    }
                    ?>

                </section>
            </section>
        </section>

        <script>
            function checkImageCount(input) {
                if (input.files.length > 6) {
                    alert("Você pode selecionar no máximo 6 imagens.");
                    input.value = '';
                }
            }

            function getSaudacao() {
                const data = new Date();
                const hora = data.getHours();

                if (hora >= 5 && hora < 12) {
                    return "Bom dia";
                } else if (hora >= 12 && hora < 18) {
                    return "Boa tarde";
                } else {
                    return "Boa noite";
                }
            }

            function exibirSaudacao(nome) {
                const saudacao = getSaudacao();
                const saudacaoElement = document.getElementById("saudacao");
                saudacaoElement.innerHTML = `${saudacao}, <span class="user-name">${nome}</span>!`;
            }

            const nomeDoUsuario = "<?php echo $_SESSION['nome']; ?>";
            exibirSaudacao(nomeDoUsuario);

            // Fechar o modal ao clicar no botão "close"
            var modal = document.getElementById("modal");
            var closeBtn = document.getElementsByClassName("close")[0];
            closeBtn.onclick = function () {
                modal.style.display = "none";
            };

            // Fechar o modal ao clicar no botão "close"
            var modal = document.getElementById("modal");
            var closeBtn = document.getElementsByClassName("close")[0];

            closeBtn.onclick = function() {
                modal.style.display = "none";
            };

            document.addEventListener("DOMContentLoaded", function() {
        
                const error = "<?= $_POST['error']; ?>";
                const success = "<?= $_POST['success']; ?>";
                const info = "<?= $_POST['info']; ?>";

                if (error !== '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: error
                    });
                } else if (success !== '') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: success
                    });
                } else if (info !== '') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Informação',
                        text: info
                    });
                } 
                
                const posts = document.querySelectorAll(".feed-single-post");

                posts.forEach((post) => {
                    const images = post.querySelectorAll(".gallery-image");
                    const modal = post.querySelector(".modal");
                    const modalImg = post.querySelector(".modal-content");
                    const closeBtn = post.querySelector(".close");
                    const prevBtn = post.querySelector(".prev");
                    const nextBtn = post.querySelector(".next");

                    let currentImageIndex = 0;

                    images.forEach((image, index) => {
                        image.addEventListener("click", function() {
                            currentImageIndex = index;
                            modal.style.display = "flex";
                            modalImg.src = image.src;
                        });
                    });

                    closeBtn.addEventListener("click", function() {
                        modal.style.display = "none";
                    });

                    prevBtn.addEventListener("click", function() {
                        if (currentImageIndex > 0) {
                            currentImageIndex--;
                            modalImg.src = images[currentImageIndex].src;
                        }
                    });

                    nextBtn.addEventListener("click", function() {
                        if (currentImageIndex < images.length - 1) {
                            currentImageIndex++;
                            modalImg.src = images[currentImageIndex].src;
                        }
                    });

                    window.addEventListener("click", function(event) {
                        if (event.target === modal) {
                            modal.style.display = "none";
                        }
                    });
                });
            });
        </script>
    </body>
</html>