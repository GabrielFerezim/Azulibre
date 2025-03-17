<?php

    namespace DankiCode\Models;

    class UsuariosModel {
        public static function emailExists($email) 
        {
            $pdo = \DankiCode\MySql::connect();
            $verificar = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
            $verificar->execute(array($email));

            if($verificar->rowCount() == 1) {
                // Email existe
                return true;
            } else {
                return false;
            }
        }

        public static function listarComunidade() 
        {
            $pdo = \DankiCode\MySql::connect();

            $comunidade = $pdo->prepare("SELECT * FROM usuarios");

            $comunidade->execute();

            return $comunidade->fetchAll();
        }

        public static function solicitarAmizade($idPara)
        {

            $pdo = \DankiCode\MySql::connect();

            $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

            $verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

            if($verificaAmizade->RowCount() == 1) {
                return false;
            } else {
                
                // Podemos inserir no banco a solicitacao
                $insertAmizade = $pdo->prepare("INSERT INTO amizades VALUES (null, ?, ?, 0);");
                if(
                $insertAmizade->execute(array($_SESSION['id'],$idPara))) {
                    return true;
                }
            }

            return true;
        }

        public static function listarAmizadesPendentes()
        {
            $pdo = \DankiCode\MySql::connect();

            $listarAmizadesPendentes = $pdo->prepare("SELECT * FROM amizades WHERE recebeu = ? AND status = 0");

            $listarAmizadesPendentes->execute(array($_SESSION['id']));

            return $listarAmizadesPendentes->fetchAll();
        }

        public static function getUsuarioById($id) 
        {
            $pdo = \DankiCode\MySql::connect();

            $usuario = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? ");

            $usuario->execute(array($id));

            return $usuario->fetch();

        }

        public static function existePedidoAmizade($idPara) 
        {
            $pdo = \DankiCode\MySql::connect();

            $verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

            $verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

            if($verificaAmizade->RowCount() == 1) {
                return false;
            } else {
                return true;
            }

        }

        public static function atualizarPedidoAmizade($enviou, $status) 
        {
            $pdo = \DankiCode\MySql::connect();

            if($status == 0) {
                // Recusei o pedido

                $del = $pdo->prepare("DELETE FROM amizades WHERE enviou = ? AND recebeu = ? AND status = 0");
                $del->execute(array($enviou, $_SESSION['id']));

            }else if ($status == 1) {
                
                $aceitarPedido = $pdo->prepare("UPDATE amizades SET status = 1 WHERE enviou = ? AND recebeu = ?");

                $aceitarPedido->execute(array($enviou, $_SESSION['id']));

                if($aceitarPedido->rowCount() == 1){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public static function listarAmigos() 
        {
            $pdo = \DankiCode\MySql::connect();
        
            $amizades = $pdo->prepare("SELECT u.id, u.nome, u.email, u.img FROM amizades a
                                     JOIN usuarios u ON (a.enviou = u.id OR a.recebeu = u.id)
                                     WHERE (a.enviou = ? OR a.recebeu = ?) AND a.status = 1
                                     AND u.id != ?");
        
            $amizades->execute(array($_SESSION['id'], $_SESSION['id'], $_SESSION['id']));
        
            return $amizades->fetchAll();
        }
        
        public static function excluirPerfil() 
        {
            $pdo = \DankiCode\MySql::connect();
            
            try {
                $pdo->beginTransaction();
                
                // Excluir imagens relacionadas aos posts do usuário
                $deletarImagens = $pdo->prepare("DELETE FROM post_images WHERE post_id IN (SELECT id FROM posts WHERE usuario_id = ?)");
                $deletarImagens->execute(array($_SESSION['id']));
                
                // Excluir posts do usuário
                $deletarPosts = $pdo->prepare("DELETE FROM posts WHERE usuario_id = ?");
                $deletarPosts->execute(array($_SESSION['id']));
                
                // Excluir amizades relacionadas ao usuário
                $deletarAmizades = $pdo->prepare("DELETE FROM amizades WHERE enviou = ? OR recebeu = ?");
                $deletarAmizades->execute(array($_SESSION['id'], $_SESSION['id']));
                
                // Excluir o usuário
                $deletarUsuario = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
                $deletarUsuario->execute(array($_SESSION['id']));
                
                $pdo->commit();
                
                session_destroy();
                
                unset($_SESSION['id']);
                unset($_SESSION['nome']);
                unset($_SESSION['img']);
                unset($_SESSION['login']);
                
                \DankiCode\Utilidades::alerta('Sua conta foi excluída com sucesso.');
                header("Location: ../Azulibre-Rede/"); // Redirecionar para o local desejado após a exclusão
                exit();
            } catch (PDOException $e) {
                $pdo->rollBack();
                \DankiCode\Utilidades::alerta('Ocorreu um erro ao excluir sua conta.');
                header("Location: perfil.php"); // Redirecione para uma página de erro, por exemplo
                exit();
            }
        }

        public static function removerAmigo($idAmigo) 
        {
            if (!is_numeric($idAmigo) || $idAmigo <= 0) {
                return false; 
            }
        
            $pdo = \DankiCode\MySql::connect();
        
            $verificarAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ? AND status = 1) OR (enviou = ? AND recebeu = ? AND status = 1)");
            $verificarAmizade->execute(array($_SESSION['id'], $idAmigo, $idAmigo, $_SESSION['id']));
        
            if ($verificarAmizade->rowCount() == 1) {
                $excluirAmizade = $pdo->prepare("DELETE FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");
                if ($excluirAmizade->execute(array($_SESSION['id'], $idAmigo, $idAmigo, $_SESSION['id']))) {
                    return true;
                }
                
            }
        
            return false;
        }

        public static function atualizarPerfil($nome, $senha)
        {
            $pdo = \DankiCode\MySql::connect();
        
            if (!empty($senha)) {
                $senha = \DankiCode\Bcrypt::hash($senha);
                $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?");
                $atualizar->execute(array($nome, $senha, $_SESSION['id']));
            } else {
                $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
                $atualizar->execute(array($nome, $_SESSION['id']));
            }
        
            $_SESSION['nome'] = $nome;
        }

        public static function listarMensagens($enviou_msg, $recebeu_msg, $chatRoomId)
        {
            $pdo = \DankiCode\MySql::connect();
    
            $listarMensagens = $pdo->prepare("SELECT * FROM chat WHERE (enviou_msg = ? AND recebeu_msg = ? AND chat_room_id = ?) OR (enviou_msg = ? AND recebeu_msg = ? AND chat_room_id = ?) ORDER BY timestamp ASC");
    
            $listarMensagens->execute(array($enviou_msg, $recebeu_msg, $chatRoomId, $recebeu_msg, $enviou_msg, $chatRoomId));
    
            return $listarMensagens->fetchAll();
        }
    
        public static function inserirMensagem($enviou_msg, $recebeu_msg, $texto_msg, $chatRoomId)
        {
            $pdo = \DankiCode\MySql::connect();
    
            try {
                $sql = "INSERT INTO chat (enviou_msg, recebeu_msg, texto_msg, timestamp, chat_room_id) VALUES (?, ?, ?, NOW(), ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($enviou_msg, $recebeu_msg, $texto_msg, $chatRoomId));
            } catch (\PDOException $e) {
                error_log($e->getMessage());
            }
        }

        public static function atualizarDescricao($userId, $descricao) {
            \DankiCode\MySql::connect()->exec("set names utf8mb4");
        
            $atualizar = \DankiCode\MySql::connect()->prepare("UPDATE usuarios SET descricao = ? WHERE id = ?");
            $atualizar->execute(array($descricao, $userId));
            $_SESSION['descricao'] = $descricao;
        }
        
    
    }
?>