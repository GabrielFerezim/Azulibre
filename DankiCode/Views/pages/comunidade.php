<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <title>Comunidade | AzuLibre</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">

        <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./estilos/reset.css">
        <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/comunidade.css" rel="stylesheet">

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
                <section class="comunidade">
                    <section class="container-comunidade">
                        <h4 class="titulo-comunidade">Amigos</h4>
                        <section class="container-comunidade-wraper">

                            <?php
                            $amigos = \DankiCode\Models\UsuariosModel::listarAmigos();

                            if (empty($amigos)) {
                                echo "Você não tem amigos ainda. Faça novas amizades!";
                            } else {
                                foreach (\DankiCode\Models\UsuariosModel::listarAmigos() as $key => $value) {

                            ?>

                                    <section class="container-comunidade-single">
                                        <section class="img-comunidade-user-single">
                                            <?php
                                            if ($value['img'] == '') {
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

                                        <section class="info-comunidade-user-single">
                                            <h2><?php echo $value['nome'] ?></h2>
                                            <p><?php echo $value['email'] ?></p>
                                            <a class="remover-amigo-link" href="<?php echo INCLUDE_PATH ?>comunidade?removerAmigo=<?php echo $value['id']; ?>">Remover amigo</a>
                                        </section>
                                    </section>

                            <?php
                                }
                            }
                            ?>

                        </section>
                    </section>

                    <br/>

                    <section class="container-comunidade">
                        <h4 class="titulo-comunidade">Sugestões de amizade</h4>
                        <section class="container-comunidade-wraper">

                            <?php
                            $comunidade = \DankiCode\Models\UsuariosModel::listarComunidade();

                            foreach ($comunidade as $key => $value) {

                                $pdo = \DankiCode\Mysql::connect();
                                $verificarAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ? AND status = 1) OR (enviou = ? AND recebeu = ? AND status = 1)");

                                $verificarAmizade->execute(array($value['id'], $_SESSION['id'], $_SESSION['id'], $value['id']));

                                if ($verificarAmizade->rowCount() == 1) {
                                    // Já sao amigos, nao existe necessidade de listar
                                    continue;
                                }

                                if ($value['id'] == $_SESSION['id']) {
                                    continue;
                                }

                            ?>

                                <section class="container-comunidade-single">
                                    <section class="img-comunidade-user-single">
                                        <?php
                                        if ($value['img'] == '') {
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

                                    <section class="info-comunidade-user-single">
                                        <h2><?php echo $value['nome']; ?></h2>
                                        <p><?php echo $value['email']; ?></p>

                                        <section class="btn-solicitar-amizade">
                                            <?php
                                            if (\DankiCode\Models\UsuariosModel::existePedidoAmizade($value['id'])) {
                                            ?>

                                                <a class="btn-solicitar" href="<?php echo INCLUDE_PATH ?>comunidade?solicitarAmizade=<?php echo $value['id']; ?>">Solicitar Amizade</a>
                                            <?php
                                            } else {
                                            ?>
                                                <a class="btn-pendente" href="javascript:void(0)">Pedido pendente...</a>
                                            <?php
                                            }
                                            ?>
                                        </section>
                                    </section>
                                </section>

                            <?php
                            }
                            ?>

                        </section>
                    </section>
                </section>
            </section>
        </section>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const error = "<?= $_POST['error']; ?>";
                const success = "<?= $_POST['success']; ?>";

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
                }
            });
        </script>
    </body>
</html>