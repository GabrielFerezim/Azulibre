<?php

    namespace DankiCode\Controllers;

    class HomeController 
    {

        public function index() 
        {
            $error = '';
            $success = '';
            $info = '';

            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

            if(isset($_GET['logout'])) {

                session_unset();
                session_destroy();

                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }            
            
            if(isset($_SESSION['login'])) {
                //renderiza a home do usuario

                //Existe pedido de amizade?

                if(isset($_GET['recusarAmizade'])) {
                    $idEnviou = (int) $_GET['recusarAmizade'];
                    \DankiCode\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,0);
                    $info = "Amizade recusada :(";
                    
                }else if(isset($_GET['aceitarAmizade'])){
                    $idEnviou = (int) $_GET['aceitarAmizade'];
                    
                    if(\DankiCode\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,1)) {
                        $success = "Amizade aceita!";
                        
                    }else{
                        $error = "Ops.. um erro ocorreu";
                    }
                }

                if (isset($_GET['deletePost'])) {
                    $postId = (int)$_GET['deletePost'];
            
                    // Verificar se o usuário logado é o dono da postagem
                    $isPostOwner = \DankiCode\Models\HomeModel::checkPostOwnership($postId, $_SESSION['id']);
            
                    if ($isPostOwner) {
                        // O usuário logado é o dono da postagem, pode excluir
                        \DankiCode\Models\HomeModel::deletePost($postId);
                        
                    } else {
                        
                    }
                }
                
                // Existe postagem no feed? vamo verificar

                //  || strlen($_POST['post_content'] < 10))
                if (isset($_FILES['post_image']) && count($_FILES['post_image']['name']) > 0) {
                    $imagePaths = [];
                
                    for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                        $uploadDir = '../AzuLibre-Rede/uploads/'; // Substitua pelo caminho correto
                        $uploadFile = $uploadDir . basename($_FILES['post_image']['name'][$i]);
                
                        if (move_uploaded_file($_FILES['post_image']['tmp_name'][$i], $uploadFile)) {
                            // Imagem foi carregada com sucesso
                            $imagePaths[] = '../AzuLibre-Rede/uploads/' . $_FILES['post_image']['name'][$i];
                        } else {
                            
                        }
                    }
                    \DankiCode\Models\HomeModel::postFeed($_POST['post_content'], $imagePaths);
                    $success = "Post feito com sucesso!";
                    header('Location: ' . INCLUDE_PATH . 'home');
                    exit();
                    
                }

                $_POST['error'] = $error;
                $_POST['success'] = $success;
                $_POST['info'] = $info;
                \DankiCode\Views\MainView::render('home');
                
            } else {    

                if (isset($_GET['from']) && $_GET['from'] === 'registrar') {
                    // Redireciona para a página de login, mas limpa quaisquer alertas ou dados de formulário
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH . 'login');
                }
                
                //ou entao renderiza pra criar conta
                if(isset($_POST['login'])) {
                    $login = $_POST['email'];
                    $senha = $_POST['senha'];
                
                    if(empty($login) || empty($senha)) {
                        // Campos de login ou senha estão vazios
                        $_POST['error'] = "Preencha todos os campos!";
                    } else {
                        // Verificar no banco de dados
                        $verifica = \DankiCode\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
                        $verifica->execute([$login]);
                
                        if($verifica->rowCount() == 0) {
                            // Não existe o usuário!
                            $_POST['error'] = "Usuário não encontrado.";
                        } else {
                            $dados = $verifica->fetch(); 
                            $senhaBanco = $dados['senha'];
                            if(\DankiCode\Bcrypt::check($senha, $senhaBanco)) {
                                // User logado com sucesso
                                $_SESSION['login'] = $dados['email'];
                                $_SESSION['id'] = $dados['id'];
                                $_SESSION['nome'] = explode(' ', $dados['nome'])[0];
                                $_SESSION['img'] = $dados['img'];

                                header('Location: ' . INCLUDE_PATH . 'home');
                                exit(); 
                            } else {
                                // Senha incorreta
                                $_POST['error'] = "Senha incorreta.";
                            }
                        }
                    }
                }
                
                \DankiCode\Views\MainView::render('login');
                
            }
        }
    }
?>