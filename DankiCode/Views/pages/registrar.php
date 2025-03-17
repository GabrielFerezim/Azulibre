<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar | AzuLibre</title>
        <link rel="stylesheet" type="text/css" href="./estilos/style.css">
        <link rel="stylesheet" type="text/css" href="./estilos/reset.css">
        <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/style.css" rel="stylesheet">
        <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <section class="form-container-login">

            <section class="logo-chamada-login-registrar">
                <section class="logo-container-registrar">
                    <a href="<?php echo INCLUDE_PATH ?>landing">
                        <img class="logo logo-passaro-registrar" src="<?php echo INCLUDE_PATH_STATIC ?>images/ColoridaAmarelo.svg" />
                    </a>
                    <a href="<?php echo INCLUDE_PATH ?>landing">
                        <img class="logo-registrar" src="<?php echo INCLUDE_PATH_STATIC ?>images/TextoAmarelo.svg" />
                    </a>
                </section>
                <p>Inicie sua jornada na escrita. Registre-se e comece a criar suas histórias!</p>
            </section>

            <section class="form-login">
                <h3 class="h3-titulo">Crie sua conta!</h3>
                <form method="post">
                    <input type="text" name="nome" placeholder="Seu nome...">
                    <input type="text" name="email" placeholder="E-mail...">
                    <input type="password" name="senha" placeholder="Senha...">
                    <input type="password" name="confirmarsenha" placeholder="Confirme sua senha...">
                    <input type="submit" name="acao" value="Registrar">
                    <input type="hidden" name="registrar" value="registrar" />

                    <p><a href="<?php echo INCLUDE_PATH ?>">Já tenho uma conta</a></p>

                </form>
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