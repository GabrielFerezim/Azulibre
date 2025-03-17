<?php

namespace DankiCode\Models;

use PDO;

if (!class_exists('DankiCode\Models\LivrosModel')) {

    class LivrosModel
    {

        public function getUserImageUrl($pdo, $nomeUsuario)
        {
            $query = "SELECT img FROM usuarios WHERE nome = :nomeUsuario";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['img'];
        }

        public function inserirLivroNoBanco($pdo, $titulo, $descricao, $genero, $pdfPath, $capaPath, $nomeUsuario, $dataHora)
        {
            $imgUsuario = $this->getUserImageUrl($pdo, $nomeUsuario);
        
            // Recupere o ID do usuário
            $queryUserId = "SELECT id FROM usuarios WHERE nome = :nomeUsuario";
            $stmtUserId = $pdo->prepare($queryUserId);
            $stmtUserId->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
            $stmtUserId->execute();
            $resultUserId = $stmtUserId->fetch(PDO::FETCH_ASSOC);
        
            if ($resultUserId) {
                $userId = $resultUserId['id'];
        
                $query = "INSERT INTO livros (usuario_id, titulo, descricao, genero, pdf_path, capa_path, nome_usuario, data_hora, img_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$userId, $titulo, $descricao, $genero, $pdfPath, $capaPath, $nomeUsuario, $dataHora, $imgUsuario]);
            } else {
                echo "Usuário não encontrado.";
            }
        }

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function getPublicacoes($userId)
        {
            $stmt = $this->pdo->prepare("SELECT
            l.*,
            u.id AS usuario_id,
            u.nome AS nome_usuario,
            u.img AS img_usuario
            FROM livros AS l
            LEFT JOIN usuarios AS u ON l.usuario_id = u.id
            WHERE
                l.usuario_id = :userId
                OR l.usuario_id IN (
                    SELECT CASE
                        WHEN enviou = :userId THEN recebeu
                        ELSE enviou
                    END
                    FROM amizades
                    WHERE (enviou = :userId OR recebeu = :userId) AND status = 1
                )
            ORDER BY l.data_hora DESC");


            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function pesquisarLivros($termo)
        {
            $termo = "$termo%";
            $query = "SELECT * FROM livros WHERE titulo LIKE :termo OR nome_usuario LIKE :termo OR genero LIKE :termo ORDER BY data_hora DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':termo', $termo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function excluirLivro($livroId, $userId)
        {
            $query = "DELETE FROM livros WHERE id = :livroId AND usuario_id = :userId";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':livroId', $livroId, PDO::PARAM_INT);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        public function getAllPublicacoes()
        {
            $stmt = $this->pdo->prepare("SELECT * FROM livros ORDER BY data_hora DESC");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function ordenarPorDataHoraDesc($resultados)
        {
            // Ordena os resultados por data_hora de forma descendente - resultado da pesquisaAA
            usort($resultados, function ($a, $b) {
                return strtotime($b['data_hora']) - strtotime($a['data_hora']);
            });

            return $resultados;
        }

    }
}
