<?php
    namespace DankiCode\Controllers;

    class ComunidadeController 
    {

        public function index() 
        {

            $error = '';
            $success = '';
            
            if(isset($_SESSION['login'])) {

                if(isset($_GET['solicitarAmizade'])) {
                    $idPara = (int) $_GET['solicitarAmizade'];
                    if(\DankiCode\Models\UsuariosModel::solicitarAmizade($idPara)) {
                        $success = "Amizade solicitada com sucesso.";
                    } else {
                        $error = "Ocorreu um erro ao solicitar a amizade.";
                    }
                }elseif (isset($_GET['removerAmigo'])) {
                    $idAmigo = (int) $_GET['removerAmigo'];
                    if (\DankiCode\Models\UsuariosModel::removerAmigo($idAmigo)) {
                        $success = "Amigo removido com sucesso.";
                    } else {
                        $error = "Ocorreu um erro ao remover o amigo.";
                    }
                }

                $_POST['error'] = $error;
                $_POST['success'] = $success;
                \DankiCode\Views\MainView::render('comunidade');
            } else {
                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>