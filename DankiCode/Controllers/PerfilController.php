<?php
namespace DankiCode\Controllers;

class PerfilController 
{
    public function index() 
    {

        $error = '';
        $confirm = '';
        $success = '';

        if(isset($_SESSION['login'])) {

            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

            if(isset($_POST['excluir-conta']) && !empty($_POST['excluir-conta'])) {
                
                \DankiCode\Models\UsuariosModel::excluirPerfil();
                $success = "Sua conta foi excluída com sucesso!";
                session_destroy();

                header("Location: ../Azulibre-Rede/");
                exit();
            }  

            if (isset($_POST['atualizar'])) {
                $pdo = \DankiCode\MySql::connect();
                $nome = trim(strip_tags($_POST['nome']));
                $senha = $_POST['senha'];
                
                $descricao = $_POST['descricao'];
                \DankiCode\Models\UsuariosModel::atualizarDescricao($_SESSION['id'], $descricao);
            
                // Certifique-se de que $_SESSION['descricao'] está sendo atualizado corretamente
                $_SESSION['descricao'] = $descricao;

                if (empty($nome) || strlen($nome) < 3) {
                    $error = "O nome não pode ser vazio e deve ter pelo menos 3 caracteres.";
                } else {
                    $atualizarNome = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
                    $atualizarNome->execute(array($nome, $_SESSION['id']));
                    $_SESSION['nome'] = $nome;
                }
                        
                if (!empty($senha)) {
                    if (strlen($senha) < 6) {
                        $error = "A senha deve ter pelo menos 6 caracteres.";
                    } else {
                    $senha = \DankiCode\Bcrypt::hash($senha);
            
                    $atualizarSenha = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
                    $atualizarSenha->execute(array($senha, $_SESSION['id']));
                    }
                }

                if($_FILES['file']['tmp_name'] != ''){
                    $file = $_FILES['file'];
                    $fileExt = explode('.',$file['name']);
                    $fileExt = $fileExt[count($fileExt) - 1];

                    if($fileExt == 'png' || $fileExt == 'jpg' || $fileExt == 'jpeg') {
                        
                        $size = intval($file['size'] / 1024);

                        if($size <= 300) { 
                            $uniqid = uniqid().'.'.$fileExt;
                            $atualizaImagem = $pdo->prepare("UPDATE usuarios SET img = ? WHERE id = ? ");
                            $atualizaImagem->execute(array($uniqid, $_SESSION['id']));
                            $_SESSION['img'] = $uniqid;
                            move_uploaded_file($file['tmp_name'], 'C:\xampp\htdocs\AzuLibre-Rede/uploads/'.$uniqid);
                            \DankiCode\Models\UsuariosModel::atualizarPerfil($nome, $senha);

                            $success = 'Seu perfil foi atualizado junto com a foto!';
                        }else{
                            $error = 'Erro ao processar seu arquivo, tente novamente.';
                        }
                        
                    }else{
                        $error = 'Erro ao processar seu arquivo.';
                        $success = ''; 
                    }
                    
                } 
                $success = empty($success) ? 'Seu perfil foi atualizado com sucesso!' : $success;
            }
            
            $_POST['confirm'] = $confirm;
            $_POST['error'] = $error;
            $_POST['success'] = $success;

            \DankiCode\Views\MainView::render('perfil');
        } else {
            \DankiCode\Utilidades::redirect(INCLUDE_PATH);
        }

        
    }

    public static function showProfile($userId) 
    {
        // Certifique-se de usar $userId para buscar o perfil correto
        $userProfile = \DankiCode\Models\UsuariosModel::getUsuarioById($userId);
    
        // Passe a variável $userProfile para a view
        \DankiCode\Views\MainView::render('perfil_outro', ['userProfile' => $userProfile]);
    }
    
    
    
}
?>