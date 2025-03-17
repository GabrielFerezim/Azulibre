<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | AzuLibre</title>
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
            <section class="logo-chamada-login">
                <section class="logo-container">
                    <a href="<?php echo INCLUDE_PATH ?>landing">
                        <img class="logo logo-passaro" src="<?php echo INCLUDE_PATH_STATIC ?>images/ColoridaAmarelo.svg" />
                    </a>
                    <a href="<?php echo INCLUDE_PATH ?>landing">
                        <img class="logo" src="<?php echo INCLUDE_PATH_STATIC ?>images/TextoAmarelo.svg" />
                    </a>
                    
                </section>
                <p>Explore, conecte-se e compartilhe. Faça o login no seu mundo literário.</p>
            </section>
            <section class="form-login">
                <h3 class="h3-titulo">Login</h3>

                <form id="form" name="login-form" method="post">
                    <input id="email" type="text" name="email" placeholder="E-mail...">
                    <input id="senha" type="password" name="senha" placeholder="Senha...">
                    <input id="acao" type="submit" name="acao" value="Entrar">
                    <input type="hidden" name="login">
                </form>

                <p><a href="<?php echo INCLUDE_PATH ?>registrar">Ainda não tenho uma conta</a></p>
                <p><a href="#" id="forgotPassword">Esqueci minha senha</a></p>
            </section>
        </section> 
        
        <section id="modal" class="modal">
            <section class="modal-overlay"></section>
            <section class="modal-content">
                <span class="close">&times;</span>
                <h2>Redefinir Senha</h2>
                <form id="resetPasswordForm">
                    <input type="email" name="email" placeholder="Seu e-mail">
                    <input type="submit" value="Redefinir Senha">
                </form>
            </section>
        </section>

        <script>

            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('modal');
                const modalOverlay = document.querySelector('.modal-overlay');
                const link = document.querySelector('#forgotPassword');
                const body = document.body;

                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    console.log('Esqueci minha senha link clicked');
                    modal.style.display = 'block';
                    modalOverlay.style.display = 'block';
                });

                const closeBtn = document.querySelector('.close');
                closeBtn.addEventListener('click', function () {
                    modal.style.display = 'none';
                    modalOverlay.style.display = 'none';
                });

                window.onclick = function (event) {
                    if (event.target == modalOverlay) {
                        modal.style.display = 'none';
                        modalOverlay.style.display = 'none';
                    }
                };

                const resetPasswordForm = document.getElementById('resetPasswordForm');
                resetPasswordForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    // Aqui você pode usar fetch ou outra chamada AJAX para enviar os dados do formulário para o backend
                });
            });

            const error = "<?= 
                $_POST['error'];
            ?>"
            
            if(error != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: error
                    
                });
            } 

        </script>
    </body>
</html>