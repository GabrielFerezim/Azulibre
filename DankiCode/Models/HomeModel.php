<?php

	namespace DankiCode\Models;

	use PDO;

	class HomeModel
	{
		
		public static function postFeed($post, $imagePaths = null) 
		{
			$pdo = \DankiCode\MySql::connect();

			$pdo = new PDO('mysql:host=localhost;dbname=azulibre_rede;charset=utf8mb4', 'root', '');

			// Converta o post para utf8mb4
			$post = mb_convert_encoding($post, 'UTF-8', 'UTF-8');
			
			$post = strip_tags($post);
			
			
			$baseImagePath = INCLUDE_PATH . 'uploads/';
			
			if (!empty($imagePaths)) {
				$galleryHtml = '<section class="image-gallery">';
				
				foreach ($imagePaths as $imagePath) {
					$imagePath = $baseImagePath . basename($imagePath);
					
					$galleryHtml .= '<img src="' . $imagePath . '" class="gallery-image">';
				}
				
				$galleryHtml .= '</section>';
				$post .= $galleryHtml;
			}
			
			$postFeed = $pdo->prepare("INSERT INTO posts VALUES (null,?,?,?)");
			$postFeed->execute(array($_SESSION['id'], $post, date('Y-m-d H:i:s', time())));
			
			$postId = $pdo->lastInsertId();
			
			foreach ($imagePaths as $imagePath) {
				$imagePath = $baseImagePath . basename($imagePath);
				
				$insertImage = $pdo->prepare("INSERT INTO post_images (post_id, image_path) VALUES (?, ?)");
				$insertImage->execute(array($postId, $imagePath));
			}
			
			$atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? where id = ? ");
			$atualizaUsuario->execute(array(date('Y-m-d H:i:s', time()), $_SESSION['id']));
		}
		
		
		public static function retrieveFriendsPosts()
		{
			$pdo = \DankiCode\MySql::connect();
			$userId = $_SESSION['id'];

			$query = "
				SELECT
					u.nome AS usuario,
					u.img AS img, 
					p.date,
					p.post AS conteudo,
					GROUP_CONCAT(pi.image_path) AS imagens,  -- Recupera as imagens para cada post
					CASE
						WHEN u.id = :userId THEN true
						ELSE false
					END AS me
				FROM usuarios AS u
				LEFT JOIN posts AS p ON u.id = p.usuario_id
				LEFT JOIN post_images AS pi ON p.id = pi.post_id  -- Junta a tabela de imagens
				WHERE
					u.id = :userId
					OR u.id IN (
						SELECT CASE
							WHEN enviou = :userId THEN recebeu
							ELSE enviou
						END
						FROM amizades
						WHERE (enviou = :userId OR recebeu = :userId) AND status = 1
					)
				AND p.post IS NOT NULL  -- Adicione esta linha para excluir posts vazios
				GROUP BY p.id  -- Agrupa por ID do post para exibir as imagens corretamente
				ORDER BY p.date DESC;
			";

			$stmt = $pdo->prepare($query);
			$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
			$stmt->execute();

			$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $posts;
		}

		public static function deletePost($postId)
		{
			$pdo = \DankiCode\MySql::connect();

			$deleteImages = $pdo->prepare("DELETE FROM post_images WHERE post_id = ?");
			$deleteImages->execute([$postId]);

			$deletePost = $pdo->prepare("DELETE FROM posts WHERE id = ?");
			$deletePost->execute([$postId]);
		}

		public static function checkPostOwnership($postId, $userId)
		{
			$pdo = \DankiCode\MySql::connect();

			$query = "SELECT 1 FROM posts WHERE id = ? AND usuario_id = ?";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$postId, $userId]);

			return $stmt->rowCount() > 0;
		}
	}
?>