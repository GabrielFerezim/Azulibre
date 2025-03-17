<?php
    ini_set('upload_max_filesize', '20M'); 
    ini_set('post_max_size', '25M'); 
    ini_set('max_execution_time', 600); 
    ini_set('max_input_time', 600); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil | AzuLibre</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="<?php echo INCLUDE_PATH_STATIC ?>./images/AzuLibreColorida.svg">
    <link rel="stylesheet" type="text/css" href="./estilos/style.css">
    <link rel="stylesheet" type="text/css" href="./estilos/reset.css">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/perfil.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-cbMEhNaeff6eT6n5A6R9eSPmz0kyR0zpIzAg3P47Rg3nN9k/6UZa1h18C03/d1TV4IuCIAw/ikN5Zv3HX2imCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <section class="main-feed">
        <?php include('includes/sidebar.php'); ?>
        <section class="feed">
            <section class="editar-perfil">
                <h2>&nbsp;&nbsp;Perfil</h2>
                <br>
                <section class="perfil-info">
                    <?php
                        if(isset($_SESSION['img']) && $_SESSION['img'] == '' ){
                            echo ('<img class="perfil-img" src="'.INCLUDE_PATH_STATIC.'images/avatar.jpeg" alt="Foto de perfil">');
                        } else {
                            echo ('<img class="perfil-img" src="'.INCLUDE_PATH.'uploads/'.$_SESSION['img'].'" alt="Foto de perfil" />');
                        }
                    ?>
                 <section class="perfil-text">
                    <h1>Nome: <?php echo $_SESSION['nome']; ?></h1>
                    <?php if (isset($_SESSION['descricao'])): ?>
                        <h3 class="descricao"><span>Biografia:</span><br> <?php echo $_SESSION['descricao']; ?></h3>
                    <?php endif; ?> 
                </section>

                </section>
                
                <section id="editModal" class="modal">
                    <section class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2>Edite seu perfil </h2>
                        
                        <form method="post" enctype="multipart/form-data">
                         <input type="hidden" name="atualizar" value="atualizar">

                         <section class="file-upload-perfil">
                            <input accept=".jpg, .png, .jpeg" type="file" name="file" id="file" class="inputfile-perfil" multiple />
                            <label for="file">
                                <i class="fa-solid fa-image" style="color: #ffffff;"></i> Editar foto de perfil
                            </label>
                        </section>

                        <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">
                        <textarea id="descricao" name="descricao" placeholder="Escreva um pouco sobre você"><?php echo isset($_SESSION['descricao']) ? $_SESSION['descricao'] : ''; ?></textarea>
                        <input type="password" name="senha" placeholder="Sua nova senha...">
                        <input type="password" name="confirmarsenha" placeholder="Confirme sua senha..." >
                        <input type="submit" name="acao" value="Salvar"><br><br>
                            
                        </form>
                        <button id="botao-fechar-editar-conta" onclick="closeModal()">Cancelar</button>
                            
                    </section>
                </section>

                <section class="editar-perfil-buttons">
                    <button id="botao-editar-conta" onclick="openModal()"><i class="fas fa-edit"></i> Editar dados</button>
                    <form method="post" action="">
                        <input id="botao-excluir-conta" type="submit" name="excluir-conta" value="Excluir conta" onclick="return confirm('Tem certeza de que deseja excluir sua conta? Esta ação é irreversível.');">
                    </form>
                </section>
                       
                <?php 
                    if(isset($_POST['excluir-conta'])) {
                        \DankiCode\Models\UsuariosModel::excluirPerfil();
                    }
                ?>
            </section>
        </section>
    </section>

    <script>
        function openModal() {
            var modal = document.getElementById('editModal');
            modal.style.display = 'flex';
        }

        function closeModal() {
            var modal = document.getElementById('editModal');
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function () {
            const confirm = "<?= $_POST['confirm'] ?>";
            const success = "<?= $_POST['success']; ?>";
            const error = "<?= $_POST['error']; ?>";

            if (confirm) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            }

            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: success
                });
            }

            if (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: error
                });
            }
        });
    </script>
</body>
</html>