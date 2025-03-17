<<<<<<< HEAD
-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: azulibre_rede
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `azulibre_rede`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `azulibre_rede` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `azulibre_rede`;

--
-- Table structure for table `amizades`
--

DROP TABLE IF EXISTS `amizades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amizades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enviou` int(11) NOT NULL,
  `recebeu` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amizades`
--

LOCK TABLES `amizades` WRITE;
/*!40000 ALTER TABLE `amizades` DISABLE KEYS */;
INSERT INTO `amizades` VALUES (122,7,38,0),(123,7,39,0),(124,8,38,0),(125,8,39,0),(126,11,38,0),(127,11,39,0),(128,12,38,0),(129,12,39,0),(130,16,38,0),(131,16,39,0),(132,18,38,0),(133,18,39,0),(134,19,38,0),(135,19,39,0),(136,23,38,0),(137,23,39,0),(138,24,38,0),(139,24,39,0),(140,5,38,0),(141,5,39,0),(142,34,38,0),(143,34,39,0),(144,33,38,0),(145,33,39,0),(146,32,38,0),(147,32,39,0),(148,29,38,0),(149,29,39,0),(150,26,38,0),(151,26,39,0),(152,38,39,0);
/*!40000 ALTER TABLE `amizades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_estrela` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `id_livro` (`id_livro`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
INSERT INTO `avaliacao` VALUES (13,5,'Adoreiii',63,11),(14,5,'Ameeei',61,11),(15,NULL,'JosÃ© de Alencar nunca erra, simplesmente apaixonado por essa histÃ³ria!!ðŸ’—',70,23),(16,5,'Nossa, um grande tesouro da literatura nacional!!',67,23),(17,5,'',69,24),(18,4,'Adorei ler esse livro, JosÃ© de Alencar foi cirÃºrgico na crÃ­tica a sociedade no sÃ©culo XIX',66,24),(19,5,'Ã“timo livro!! Super necessÃ¡rio para nÃ£o esquecermos da histÃ³ria do nosso paÃ­sâœŠðŸ¿âœŠðŸ¿',62,26),(20,5,'',70,26);
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `enviou_msg` int(11) NOT NULL,
  `recebeu_msg` int(11) NOT NULL,
  `texto_msg` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `genero` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `capa_path` varchar(255) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `data_hora` datetime NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `img_usuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`usuario_id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (61,'A casa da minha vÃ³','Ã‰ atravÃ©s das avÃ³s que se consegue centrar a mÃ¡gica e o carisma que uma famÃ­lia precisa nutrir. A casa da avÃ³ Ã© centro do universo fantasioso recheada com sons, acontecimentos, cheiros e cores... histÃ³rias para alimentar qualquer infÃ¢ncia e vida adulta.','CrÃ´nica','../Azulibre-Rede/uploads_livros/A_casa_da_minha_vo.pdf','../Azulibre-Rede/uploads_livros/a-casa-da-minha-vo_capa.jpg','Miguel','2023-12-10 14:53:23',19,'6575142a376ee.jpeg'),(62,'Ãšrsula e outras obras','Ãšrsula Ã© um romance de Maria Firmina dos Reis, considerado o primeiro romance da literatura afro-brasileira. O livro conta a histÃ³ria de Ãšrsula, uma jovem mestiÃ§a filha de um branco com uma mulher negra escravizada3. Ãšrsula Ã© criada por sua mÃ£e e avÃ³, ambas negras, e cresce em um ambiente de opressÃ£o e discriminaÃ§Ã£o racial. Quando sua mÃ£e Ã© vendida como escrava, Ãšrsula luta para libertÃ¡-la e se envolve em um movimento abolicionista.','Conto','../Azulibre-Rede/uploads_livros/ursula_e_outras_obras.pdf','../Azulibre-Rede/uploads_livros/ursula_e_outras_obras_capa.jpeg','Miguel','2023-12-10 15:04:26',19,'6575142a376ee.jpeg'),(63,'MemÃ³ria de um Sargento de MilÃ­cia','MemÃ³rias de um Sargento de MilÃ­cias Ã© um romance de folhetim publicado originalmente no Correio Mercantil entre 1852 e 18531. Escrito por Manuel AntÃ´nio de Almeida, o livro conta as memÃ³rias de Leonardo, uma crianÃ§a travessa que se torna um \"malandro\" antes de se estabilizar como sargento de milÃ­cias. A narrativa incorpora a linguagem das ruas, classes mÃ©dia e baixa, fugindo aos padrÃµes romÃ¢nticos da Ã©poca. O livro estÃ¡ disponÃ­vel para download.','Romance','../Azulibre-Rede/uploads_livros/Memorias_de_um_sargento.pdf','../Azulibre-Rede/uploads_livros/memorias_de_um_sargento_capa.jpeg','Pedro','2023-12-10 15:07:44',7,'65750a091acf2.jpg'),(64,'Senhora ','A protagonista AurÃ©lia Camargo Ã© filha de uma costureira pobre e deseja se casar com o namorado, Fernando Seixas. O rapaz, porÃ©m, troca AurÃ©lia por Adelaide Amaral, uma menina rica que proporcionaria um futuro mais promissor. O tempo passa e AurÃ©lia torna-se Ã³rfÃ£ e recebe uma heranÃ§a enorme do avÃ´. Com a fortuna que adquire, a moÃ§a ascende socialmente e comeÃ§a a ser vista com outros olhos, principiando a ser cobiÃ§ada por pretendentes interesseiros.','Romance','../Azulibre-Rede/uploads_livros/Senhora.pdf','../Azulibre-Rede/uploads_livros/Senhora_capa.jpeg','Ana','2023-12-10 15:09:23',8,'65750c3ded596.jpeg'),(65,'O abolicionismo','O Abolicionismo foi um movimento polÃ­tico e social que lutou pelo fim da escravidÃ£o no Brasil na segunda metade do sÃ©culo XIX. O movimento contou com a participaÃ§Ã£o de vÃ¡rios segmentos sociais, como polÃ­ticos, advogados, mÃ©dicos, jornalistas, artistas e estudantes. O abolicionismo Ã© tambÃ©m uma teoria que defende o fim do sistema penal, por este constituir um sofrimento inÃºtil e nocivo. Parte do pressuposto de que o conceito de crime Ã© errÃ´neo e o direito penal deve ser substituÃ­do por formas de conciliaÃ§Ã£o e reparaÃ§Ã£o realizadas pela prÃ³pria sociedade civil, sem a interferÃªncia coercitiva do Estado.','HistÃ³ria','../Azulibre-Rede/uploads_livros/o_abolicionismo.pdf','../Azulibre-Rede/uploads_livros/o_aboliciosnimo_capa.jpeg','Laura','2023-12-10 15:49:28',12,'65750d9ea2c89.jpg'),(66,'A Pata da Gazela','A Pata da Gazela Ã© um romance de JosÃ© de Alencar publicado em 1870. A histÃ³ria gira em torno de HorÃ¡cio, Leopoldo, Laura e AmÃ©lia. HorÃ¡cio se apaixona pela dona dos pÃ©s desconhecidos. Ele percebe que sua deformidade fÃ­sica o impede de conquistar Leopolda, uma jovem rica e bela. O livro Ã© uma crÃ­tica Ã  sociedade do sÃ©culo XIX.','Romance','../Azulibre-Rede/uploads_livros/A_pata_da_gazela.pdf','../Azulibre-Rede/uploads_livros/a_pata_da_gazela_capa.jpeg','Isabela','2023-12-10 15:52:14',16,'65750e4ae971c.jpg'),(67,'Primeiros cantos','Primeiros Cantos Ã© um livro de poesias de GonÃ§alves Dias, publicado em 1847. O livro Ã© considerado um marco do romantismo brasileiro e contÃ©m poemas que exaltam a natureza, a cultura e a histÃ³ria do Brasil. O poema mais famoso do livro Ã© â€œCanÃ§Ã£o do ExÃ­lioâ€, que comeÃ§a com os versos â€œMinha terra tem palmeiras, / Onde canta o sabiÃ¡â€.','Poesia ContemporÃ¢nea','../Azulibre-Rede/uploads_livros/Primeiros_cantos.pdf','../Azulibre-Rede/uploads_livros/primieros_cantos_capa.jpeg','Julia','2023-12-10 16:01:54',18,'65751219899ff.jpeg'),(68,'Iracema','Autor: JosÃ© de Alencar\r\nIracema Ã© uma obra que traz como protagonista uma mulher indÃ­gena com caracterÃ­sticas fÃ­sicas e psicolÃ³gicas muito idealizadas. A histÃ³ria tem inÃ­cio quando Martim, portuguÃªs responsÃ¡vel por defender o territÃ³rio brasileiro de outros invasores europeus, perde-se na mata, em localidade que hoje corresponde ao litoral do CearÃ¡.','Romance','../Azulibre-Rede/uploads_livros/iracema.pdf','../Azulibre-Rede/uploads_livros/iracema_capa.jpg','Theo','2023-12-10 16:05:19',23,'65751832383da.jpeg'),(69,'Ãšltimos cantos','Autor: GonÃ§alves Dias\r\nNesta terceira coletÃ¢nea de poemas, o autor repete a distribuiÃ§Ã£o dos poemas em grupos adotada nos Primeiros Cantos: â€œPoesias americanasâ€, â€œPoesias diversasâ€ e â€œHinosâ€.','Poesia ContemporÃ¢nea','../Azulibre-Rede/uploads_livros/ultimos_cantos.pdf','../Azulibre-Rede/uploads_livros/ultimos_cantos_capa.jpeg','Livia','2023-12-10 16:07:29',24,'6575189fa0111.jpeg'),(70,'A viuvinha','A Viuvinha Ã© um livro de JosÃ© de Alencar publicado pela primeira vez em 1860. O romance urbano Ã© encenado no Rio de Janeiro em meados do sÃ©culo XIX e tem como protagonista Jorge, que apÃ³s a orfandade, dÃ¡ cabo da fortuna deixada pelo pai e, afundado em dÃ­vidas, nÃ£o vÃª outra saÃ­da alÃ©m de simular o prÃ³prio suicÃ­dio. O livro aborda os conflitos psicolÃ³gicos vividos pela sociedade burguesa carioca com a idealizaÃ§Ã£o do amor eterno e da honra familiar como valores fundamentais do carÃ¡ter humano.','Romance','../Azulibre-Rede/uploads_livros/a_viuvinha (1).pdf','../Azulibre-Rede/uploads_livros/a-viuvinha.jpg','Livia','2023-12-10 18:59:11',24,'6575189fa0111.jpeg');
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_images`
--

DROP TABLE IF EXISTS `post_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_images`
--

LOCK TABLES `post_images` WRITE;
/*!40000 ALTER TABLE `post_images` DISABLE KEYS */;
INSERT INTO `post_images` VALUES (175,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24 (2).jpeg'),(176,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24.jpeg'),(177,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23 (1).jpeg'),(178,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23.jpeg'),(179,602,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.26.jpeg'),(180,602,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25 (1).jpeg'),(181,602,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25.jpeg'),(182,605,'http://localhost/Azulibre-Rede/uploads/0204128dc387a3cc8a832ca4a6af7039.jpg'),(183,606,'http://localhost/Azulibre-Rede/uploads/602120cb0f864cac9600e33c137489b5.jpg'),(185,609,'http://localhost/Azulibre-Rede/uploads/e9b944514038b9a625512f7bfc52e283.jpg'),(186,610,'http://localhost/Azulibre-Rede/uploads/a-viuvinha-jose-de-alencar-leni-100029.jpg'),(187,611,'http://localhost/Azulibre-Rede/uploads/f841dfc2afc36567ff9dd057ef781aac.jpg'),(188,612,'http://localhost/Azulibre-Rede/uploads/61dae38bfa0ee15135b4368b1bf972cc.jpg'),(189,613,'http://localhost/Azulibre-Rede/uploads/home-library-office-colour-coded-books-Xenatin.jpg'),(190,614,'http://localhost/Azulibre-Rede/uploads/Caminho-Longo-Vinícius-Fernandes-Irmãos-Livreiros.jpg'),(191,614,'http://localhost/Azulibre-Rede/uploads/51bPc4p9XnL.jpg'),(192,614,'http://localhost/Azulibre-Rede/uploads/41l0ZeWjsgL.jpg'),(193,615,'http://localhost/Azulibre-Rede/uploads/7d783256ac85bf8b1bdcbfed20bcb1b0.jpg'),(194,617,'http://localhost/Azulibre-Rede/uploads/17b49395f9af89db8e897bc751f037bc.jpg'),(195,619,'http://localhost/Azulibre-Rede/uploads/arte_1.png'),(196,619,'http://localhost/Azulibre-Rede/uploads/arte_2.png'),(197,619,'http://localhost/Azulibre-Rede/uploads/arte_3.png');
/*!40000 ALTER TABLE `post_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `post` mediumtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=621 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (601,7,'\"IUB ARAM\" é uma obra fascinante que revela a história de Samuel Pereira, um professor do ensino fundamental de Santa Isabel, São Paulo. Envolvendo referências folclóricas e indígenas, o livro não apenas explora contos conhecidos, mas também introduz uma nova lenda, enriquecendo a herança cultural brasileira. Recomendo a leitura para aqueles que buscam uma conexão mais profunda com as histórias que moldam nossa terra. <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24 (2).jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24.jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23 (1).jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23.jpeg\" class=\"gallery-image\"></section>','2023-12-09 21:44:03'),(602,8,'Mentes Poéticas II reune 95 autoras e autores de diversos estados do Brasil e também de Portugal, contando com o olhar atento e crítico do escritor Aleilton Fonseca e da professora Sinéia Maria Teles Silveira, que nos brindaram com o prefácio e o texto para as orelhas, respectivamente. VALE MUITO A PENA, leiam!!! ✨✨✨<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.26.jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25 (1).jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25.jpeg\" class=\"gallery-image\"></section>','2023-12-09 21:51:03'),(603,11,'Tarde chuvosa e eu aqui, imerso em um mundo de letras e histórias....','2023-12-09 21:58:38'),(604,12,'Mais um dia, mais uma página escrita. A inspiração não tira férias! A meta é não parar hahaha','2023-12-09 21:59:45'),(605,16,'Café, música e uma boa leitura. A receita perfeita para um final de semana relaxante. ☕️<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/0204128dc387a3cc8a832ca4a6af7039.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:02:08'),(606,19,'Hoje tô na vibe de postar um livro aqui. Mas não sei ainda kkkk será que alguém vai ler? Avaliem com sinceridade, por favor!! Sempre acho q meus livros poderiam melhorar :\\<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/602120cb0f864cac9600e33c137489b5.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:27:46'),(609,21,'Gente, sério, estou impressionado com o talento dessa comunidade! Só tem artista incrível por aqui. Vocês arrasam demais! <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/e9b944514038b9a625512f7bfc52e283.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:41:58'),(610,23,'Esse friozinho pede um bom livro, e nada melhor que um romance clássico. Que tal se perder nas páginas de um José de Alencar?\r\nO escolhido de hoje é \"A Viuvinha\", já disponível em livros, inclusive!! :) Vou ler no kindle haha<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/a-viuvinha-jose-de-alencar-leni-100029.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:44:57'),(611,24,'Desapegando de alguns livros nacionais incríveis! ✨ Quem ama leitura vai adorar essas opções. Todos em ótimo estado. Interessados, chama no direct do insta! @livia_books <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/f841dfc2afc36567ff9dd057ef781aac.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:48:03'),(612,26,'Doando livros para quem ama ler tanto quanto eu! Se interessou por algum título? Manda mensagem no direct que combinamos a entrega. Vamos espalhar o amor pela leitura!! Meu instagram: @helen_rocha91<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/61dae38bfa0ee15135b4368b1bf972cc.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:49:41'),(613,29,'Home office vibes! haha Trabalhando no meu cantinho favorito, acompanhado de um bom livro para os intervalos.<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/home-library-office-colour-coded-books-Xenatin.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:52:25'),(614,32,'Sábado de sol e eu aqui, na minha bolha literária. Simplesmente não saio mais dessa plataforma, help!! kkkk\r\nAproveitando a deixa pra dizer que estou em dúvida entre quais dessa maravilhas NACIONAIS comprar, até porque a representatividade nos livros brasileiros é de suma importância, né?? No fim acho q comprarei os três!<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/Caminho-Longo-Vinícius-Fernandes-Irmãos-Livreiros.jpg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/51bPc4p9XnL.jpg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/41l0ZeWjsgL.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:55:52'),(615,33,'Às vezes, bate aquela insegurança na hora de compartilhar meus gostos literários... Será que vão gostar? Mas a verdade é que cada livro conta uma história única, assim como cada leitor. Vamos espalhar nossas escolhas e trocar experiências, afinal, a diversidade literária é incrível! <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/7d783256ac85bf8b1bdcbfed20bcb1b0.jpg\" class=\"gallery-image\"></section>','2023-12-09 23:03:19'),(616,33,'Aliás, estou muito feliz aqui. Me sinto confortável em saber que estou num ambiente que todos prezam pela leitura nacional, a qual é uma luta todos os dias trazer visibilidade. A junção de um feed para dar opiniões, recomendar livros, anunciar vendas/doações juntamente de publicar livros e ler é simplesmente sensacional. \r\n#JuntosPelaLiteraturaBrasileira ','2023-12-09 23:06:54'),(617,34,'Amar é pouco para descrever o que sinto pelos livros brasileiros (que eu sequer sabia da existência) que encontro aqui! Cada história é como uma viagem a um novo mundo, repleto de emoções e descobertas.<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/17b49395f9af89db8e897bc751f037bc.jpg\" class=\"gallery-image\"></section>','2023-12-09 23:11:45'),(618,5,'É uma honra sentir que faço parte de uma comunidade com uma causa tão grande.. a literatura brasileira é magnífica e precisa ser mais vista!!','2023-12-09 23:14:07'),(619,38,'Opa, galera. Queria compartilhar com vocês três imagens que criei recentemente como editor e ilustrador de livros. Estou muito empolgado em fazer parte deste espaço incrível de livros brasileiros e espero que gostem do meu trabalho. Para mais artes me sigam no meu instagram: @cedrick_arts! Além de ilustrações, também já colaborei em capas de livros e estou aqui para trocar experiências e quem sabe colaborar em mais projetos!<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/arte_1.png\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/arte_2.png\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/arte_3.png\" class=\"gallery-image\"></section>','2023-12-10 14:29:55'),(620,39,'Finalmente decidi me juntar a essa incrível comunidade literária que celebra a literatura nacional como ninguém mais! Como amante de romances, estou super empolgada em descobrir tantos autores brasileiros talentosos por aqui. Sempre amei os romances estrangeiros, mas agora estou pronta para mergulhar de cabeça nas histórias apaixonantes que nossa terra tem a oferecer! ✨','2023-12-10 14:37:34');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` mediumtext NOT NULL,
  `ultimo_post` datetime NOT NULL,
  `descricao` mediumtext DEFAULT NULL,
  `img` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'João','joao.silva@gmail.com','$2a$08$NDE4NTcxMTAwNjU3NGZkZO4H8.8R02e5BrvJCMU6PRQzjPykEYhfW','2023-12-09 23:14:07','','65751ec4c4644.jpg'),(6,'Maria','maria.oliv@gmail.com','$2a$08$MTk4MTAyMjEzNDY1NzRmZOoz9SDZcIU03xMbji4jeAujQuJ1UVE4i','2023-12-09 20:53:45','','6575254629daa.jpeg'),(7,'Pedro','pedro.santos@gmail.com','$2a$08$MTEwMDk3NTAyMTY1NzRmZOd4.ufSHt2KKnOgnvscmDPOVTRrEUPum','2023-12-09 21:44:03','Aventureiro das palavras e apaixonado por mundos imaginários! 📚✨ Desbravando cada página com curiosidade e entusiasmo. 🌈❤️','65750a091acf2.jpg'),(8,'Ana','ana.costa@gmail.com','$2a$08$MTU3OTQzMDY1NDY1NzRmZO6Hac4MZrPrRtTGEnEEWAt3KPlI61dAa','2023-12-09 21:51:03','Cada estrofe é um fragmento do meu mundo interior, onde os sentimentos ganham vida e as emoções se transformam em delicadas melodias.','65750c3ded596.jpeg'),(9,'Carlos','carlos.pera@gmail.com','$2a$08$MTQwODcyNzUwNDY1NzRmZOFovs2yHt0eDktmXFsYac3rtM/lMQXbS','2023-12-09 20:55:58','',''),(10,'Beatriz','beatriz.alm@gmail.com','$2a$08$MTg4NDMwNzM5NjY1NzRmZODOsbM9VZFOfqMmG8NUerPb5Sfa/1qLm','2023-12-09 20:56:36','','6575251d3cae8.jpeg'),(11,'Lucas Rocha','lucas.rocha@gmail.com','$2a$08$MTI4NjQ5MjgwNjY1NzRmZOkspeWrhEGL1QtrdAKriXsWeHhz5eD0G','2023-12-09 21:58:38','',''),(12,'Laura','laura.lima@gmail.com','$2a$08$MTc5Mzc0NzI2MTY1NzRmZeQNeu3mxPiA/JoqG6LTXXoyn5nVm/9Lq','2023-12-09 21:59:45','','65750d9ea2c89.jpg'),(13,'Gabriel','gabriel.oliveira@gmail.com','$2a$08$NjgzNzUwMzA4NjU3NGZmMu4gr5ZVlCsGAvz8tVyBuu9KVwPHuXeUa','2023-12-09 20:58:47','','657524b3051b1.jpeg'),(14,'Sofia','sofia.ferndes@gmail.com','$2a$08$MjUyNzAxNjQ0NjU3NGZmN.QCe.iHMN7CyNnzwglQlJkXl9SyssU5y','2023-12-09 20:59:10','','6575255caaf13.jpeg'),(15,'Matheus Peres','matheus.peres@gmail.com','$2a$08$MTUzMDQ4MzA5ODY1NzRmZeiZH61FgiQSwWV2XQQqwrqj1eKeMBbLS','2023-12-09 20:59:50','',''),(16,'Isabela','isabela.rodrigues@gmail.com','$2a$08$MjExNzAyNTU5MTY1NzRmZeAFhAhlVjxuS/70H0aOztAOqAFuZRKei','2023-12-09 22:02:08','','65750e4ae971c.jpg'),(17,'Enzo Carvalho','enzo.carvalho@gmail.com','$2a$08$MTQyNzM5ODU5MjY1NzRmZe/mVrRx6p7rVDWYYyd6uWKd/qNNJa2z2','2023-12-09 21:01:30','',''),(18,'Julia','julia.martins@gmail.com','$2a$08$MTk0ODA2NDcwMTY1NzRmZeH.77pGx1OUkdJKp6zfUYxKsgfP4Zh.a','2023-12-09 21:01:52','','65751219899ff.jpeg'),(19,'Miguel','miguel.lima@gmail.com','$2a$08$MTE4MTg5ODQzODY1NzUwM.S3BosIDu7tbCVsbc2FM5l0iTQSKekLy','2023-12-09 22:27:46','','6575142a376ee.jpeg'),(20,'Manuela Souza','manuela.souza@gmail.com','$2a$08$MTQ3NDM3MTQ5NjU3NTAwMOVc4J/phwv4B2KpYBeLEHMQOUkOuuc6G','2023-12-09 21:02:39','',''),(21,'Leonardo','leonardo.paiva@gmail.com','$2a$08$NTUzMDgxMTAwNjU3NTAwMuxuUk4guDQM325RcerxEI9fzJ.tAlTTS','2023-12-09 22:41:58','','6575177d493be.jpeg'),(22,'Valentina Santos','valent.santos@gmail.com','$2a$08$MzE4ODkxOTY5NjU3NTAwNOH/Etx6NhITP0fuvj3hmg88d80D9jKFa','2023-12-09 21:03:34','',''),(23,'Theo','theo.guedes@gmail.com','$2a$08$OTU5NDU1OTg2NTc1MDA3M.fCMZmJ6zDnOSA4IVV.ERGiyHJsFFM8C','2023-12-09 22:44:57','','65751832383da.jpeg'),(24,'Livia','livia.costa@gmail.com','$2a$08$MTI3NDMwMTkxMDY1NzUwM.TgwT6.x3TZgrZqdp.q2s3QsqG/ngH7u','2023-12-09 22:48:03','','6575189fa0111.jpeg'),(25,'Arthur Almeida','arthur.almeida@gmail.com','$2a$08$MjIwOTU3ODgyNjU3NTAwOO5NdV.0VeWVE128zAxw5V2Z9gO7pzZUu','2023-12-09 21:04:35','',''),(26,'Helena','helena.rocha@gmail.com','$2a$08$MTQyMTM2OTc3MzY1NzUwM.qKj2MW53rmguSaJ5vqSWx3PNrysKASm','2023-12-09 22:49:41','','657519014b994.jpeg'),(27,'Bernardo Nunes','bernardo.nunes@gmail.com','$2a$08$NzI5NzkwODQ5NjU3NTAwYe2Rtbni8ySsQd9.wWLP6NEYN9N0DQ3y.','2023-12-09 21:05:16','',''),(28,'Giovanna Pontes','giovanna.pontes@gmail.com','$2a$08$ODAyNjE1MzE0NjU3NTAwZOsB7NSer7cZEThjbYOKTiWH6napjIgEa','2023-12-09 21:05:55','',''),(29,'Lorenzo','lorenzo.silva@gmail.com','$2a$08$MTYwMzk2MTM4MzY1NzUwM.Ipq6I/8d/czAUCsXEfT8FRRd0tKurRC','2023-12-09 22:52:25','','6575196f9977f.jpeg'),(30,'Gabriele Campos','gabrielecampos@gmail.com','$2a$08$Njg5NzU4OTQzNjU3NTAxMeJJdWflTlc8PWuZcRmrJvRW8lHscJkN6','2023-12-09 21:06:59','',''),(31,'Benjamin. Costa','benjamin.costa@gmail.com','$2a$08$MTM3MzQ5ODYwMDY1NzUwMO./t2QrqbSQU2cK3X2/W3KGO3Fr.6Sqq','2023-12-09 21:07:28','',''),(32,'Cecília','cecilia.almeida@gmail.com','$2a$08$ODg3NDQ5ODcyNjU3NTAxNOb1fD.KCR.nuBjyBn2Qy3Tk6sWgfH6aG','2023-12-09 22:55:52','','65751b1069fd0.jpeg'),(33,'Murilo','murilo.alvares@gmail.com','$2a$08$MjA1NjMzMzYwOTY1NzUwMO0QkcGR7PN7hxOpt0PkmKD3QaThZDBde','2023-12-09 23:06:54','','65751cb49b040.jpeg'),(34,'Eloá','eloa.lima@gmail.com','$2a$08$MzM0ODIyNDk2NTc1MDE4NOEJ..n3BJRtUIr.Jy.iz/SFBAJ03kixK','2023-12-09 23:11:45','','65751deb82383.jpeg'),(37,'Amanda','amanda@gmail.com','$2a$08$MTc2MTQ0MDA5NTY1NzVjN.UXFeMIEXczB0Lu/ztT7b/sHRT.8uh7K','2023-12-10 11:01:20','',''),(38,'Cedrick','cedrickborg@gmail.com','$2a$08$MTgzNTMyNzQ5MDY1NzVmMumCGG3K1G8VzWT5vhuuCkhoZN.MqSqmS','2023-12-10 14:29:55','','6575f53f713f3.jpg'),(39,'Rafaela','rafagoldine@gmail.com','$2a$08$MTk5MjQ4MTg5OTY1NzVmNe5ssaUiL3cr9sJWxyRgql9FpOXxdSHwe','2023-12-10 14:37:34','','6575f71971824.jpg');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-10 23:58:11
=======
-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: azulibre_rede
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `azulibre_rede`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `azulibre_rede` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `azulibre_rede`;

--
-- Table structure for table `amizades`
--

DROP TABLE IF EXISTS `amizades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amizades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enviou` int(11) NOT NULL,
  `recebeu` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amizades`
--

LOCK TABLES `amizades` WRITE;
/*!40000 ALTER TABLE `amizades` DISABLE KEYS */;
INSERT INTO `amizades` VALUES (122,7,38,0),(123,7,39,0),(124,8,38,0),(125,8,39,0),(126,11,38,0),(127,11,39,0),(128,12,38,0),(129,12,39,0),(130,16,38,0),(131,16,39,0),(132,18,38,0),(133,18,39,0),(134,19,38,0),(135,19,39,0),(136,23,38,0),(137,23,39,0),(138,24,38,0),(139,24,39,0);
/*!40000 ALTER TABLE `amizades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_estrela` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `id_livro` (`id_livro`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
INSERT INTO `avaliacao` VALUES (13,5,'Adoreiii',63,11),(14,5,'Ameeei',61,11);
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `enviou_msg` int(11) NOT NULL,
  `recebeu_msg` int(11) NOT NULL,
  `texto_msg` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `genero` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `capa_path` varchar(255) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `data_hora` datetime NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `img_usuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`usuario_id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (61,'A casa da minha vÃ³','Ã‰ atravÃ©s das avÃ³s que se consegue centrar a mÃ¡gica e o carisma que uma famÃ­lia precisa nutrir. A casa da avÃ³ Ã© centro do universo fantasioso recheada com sons, acontecimentos, cheiros e cores... histÃ³rias para alimentar qualquer infÃ¢ncia e vida adulta.','CrÃ´nica','../Azulibre-Rede/uploads_livros/A_casa_da_minha_vo.pdf','../Azulibre-Rede/uploads_livros/a-casa-da-minha-vo_capa.jpg','Miguel','2023-12-10 14:53:23',19,'6575142a376ee.jpeg'),(62,'Ãšrsula e outras obras','Ãšrsula Ã© um romance de Maria Firmina dos Reis, considerado o primeiro romance da literatura afro-brasileira. O livro conta a histÃ³ria de Ãšrsula, uma jovem mestiÃ§a filha de um branco com uma mulher negra escravizada3. Ãšrsula Ã© criada por sua mÃ£e e avÃ³, ambas negras, e cresce em um ambiente de opressÃ£o e discriminaÃ§Ã£o racial. Quando sua mÃ£e Ã© vendida como escrava, Ãšrsula luta para libertÃ¡-la e se envolve em um movimento abolicionista.','Conto','../Azulibre-Rede/uploads_livros/ursula_e_outras_obras.pdf','../Azulibre-Rede/uploads_livros/ursula_e_outras_obras_capa.jpeg','Miguel','2023-12-10 15:04:26',19,'6575142a376ee.jpeg'),(63,'MemÃ³ria de um Sargento de MilÃ­cia','MemÃ³rias de um Sargento de MilÃ­cias Ã© um romance de folhetim publicado originalmente no Correio Mercantil entre 1852 e 18531. Escrito por Manuel AntÃ´nio de Almeida, o livro conta as memÃ³rias de Leonardo, uma crianÃ§a travessa que se torna um \"malandro\" antes de se estabilizar como sargento de milÃ­cias. A narrativa incorpora a linguagem das ruas, classes mÃ©dia e baixa, fugindo aos padrÃµes romÃ¢nticos da Ã©poca. O livro estÃ¡ disponÃ­vel para download.','Romance','../Azulibre-Rede/uploads_livros/Memorias_de_um_sargento.pdf','../Azulibre-Rede/uploads_livros/memorias_de_um_sargento_capa.jpeg','Pedro','2023-12-10 15:07:44',7,'65750a091acf2.jpg'),(64,'Senhora ','A protagonista AurÃ©lia Camargo Ã© filha de uma costureira pobre e deseja se casar com o namorado, Fernando Seixas. O rapaz, porÃ©m, troca AurÃ©lia por Adelaide Amaral, uma menina rica que proporcionaria um futuro mais promissor. O tempo passa e AurÃ©lia torna-se Ã³rfÃ£ e recebe uma heranÃ§a enorme do avÃ´. Com a fortuna que adquire, a moÃ§a ascende socialmente e comeÃ§a a ser vista com outros olhos, principiando a ser cobiÃ§ada por pretendentes interesseiros.','Romance','../Azulibre-Rede/uploads_livros/Senhora.pdf','../Azulibre-Rede/uploads_livros/Senhora_capa.jpeg','Ana','2023-12-10 15:09:23',8,'65750c3ded596.jpeg'),(65,'O abolicionismo','O Abolicionismo foi um movimento polÃ­tico e social que lutou pelo fim da escravidÃ£o no Brasil na segunda metade do sÃ©culo XIX. O movimento contou com a participaÃ§Ã£o de vÃ¡rios segmentos sociais, como polÃ­ticos, advogados, mÃ©dicos, jornalistas, artistas e estudantes. O abolicionismo Ã© tambÃ©m uma teoria que defende o fim do sistema penal, por este constituir um sofrimento inÃºtil e nocivo. Parte do pressuposto de que o conceito de crime Ã© errÃ´neo e o direito penal deve ser substituÃ­do por formas de conciliaÃ§Ã£o e reparaÃ§Ã£o realizadas pela prÃ³pria sociedade civil, sem a interferÃªncia coercitiva do Estado.','HistÃ³ria','../Azulibre-Rede/uploads_livros/o_abolicionismo.pdf','../Azulibre-Rede/uploads_livros/o_aboliciosnimo_capa.jpeg','Laura','2023-12-10 15:49:28',12,'65750d9ea2c89.jpg'),(66,'A Pata da Gazela','A Pata da Gazela Ã© um romance de JosÃ© de Alencar publicado em 1870. A histÃ³ria gira em torno de HorÃ¡cio, Leopoldo, Laura e AmÃ©lia. HorÃ¡cio se apaixona pela dona dos pÃ©s desconhecidos. Ele percebe que sua deformidade fÃ­sica o impede de conquistar Leopolda, uma jovem rica e bela. O livro Ã© uma crÃ­tica Ã  sociedade do sÃ©culo XIX.','Romance','../Azulibre-Rede/uploads_livros/A_pata_da_gazela.pdf','../Azulibre-Rede/uploads_livros/a_pata_da_gazela_capa.jpeg','Isabela','2023-12-10 15:52:14',16,'65750e4ae971c.jpg'),(67,'Primeiros cantos','Primeiros Cantos Ã© um livro de poesias de GonÃ§alves Dias, publicado em 1847. O livro Ã© considerado um marco do romantismo brasileiro e contÃ©m poemas que exaltam a natureza, a cultura e a histÃ³ria do Brasil. O poema mais famoso do livro Ã© â€œCanÃ§Ã£o do ExÃ­lioâ€, que comeÃ§a com os versos â€œMinha terra tem palmeiras, / Onde canta o sabiÃ¡â€.','Poesia ContemporÃ¢nea','../Azulibre-Rede/uploads_livros/Primeiros_cantos.pdf','../Azulibre-Rede/uploads_livros/primieros_cantos_capa.jpeg','Julia','2023-12-10 16:01:54',18,'65751219899ff.jpeg'),(68,'Iracema','Autor: JosÃ© de Alencar\r\nIracema Ã© uma obra que traz como protagonista uma mulher indÃ­gena com caracterÃ­sticas fÃ­sicas e psicolÃ³gicas muito idealizadas. A histÃ³ria tem inÃ­cio quando Martim, portuguÃªs responsÃ¡vel por defender o territÃ³rio brasileiro de outros invasores europeus, perde-se na mata, em localidade que hoje corresponde ao litoral do CearÃ¡.','Romance','../Azulibre-Rede/uploads_livros/iracema.pdf','../Azulibre-Rede/uploads_livros/iracema_capa.jpg','Theo','2023-12-10 16:05:19',23,'65751832383da.jpeg'),(69,'Ãšltimos cantos','Autor: GonÃ§alves Dias\r\nNesta terceira coletÃ¢nea de poemas, o autor repete a distribuiÃ§Ã£o dos poemas em grupos adotada nos Primeiros Cantos: â€œPoesias americanasâ€, â€œPoesias diversasâ€ e â€œHinosâ€.','Poesia ContemporÃ¢nea','../Azulibre-Rede/uploads_livros/ultimos_cantos.pdf','../Azulibre-Rede/uploads_livros/ultimos_cantos_capa.jpeg','Livia','2023-12-10 16:07:29',24,'6575189fa0111.jpeg');
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_images`
--

DROP TABLE IF EXISTS `post_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_images`
--

LOCK TABLES `post_images` WRITE;
/*!40000 ALTER TABLE `post_images` DISABLE KEYS */;
INSERT INTO `post_images` VALUES (175,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24 (2).jpeg'),(176,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24.jpeg'),(177,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23 (1).jpeg'),(178,601,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23.jpeg'),(179,602,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.26.jpeg'),(180,602,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25 (1).jpeg'),(181,602,'http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25.jpeg'),(182,605,'http://localhost/Azulibre-Rede/uploads/0204128dc387a3cc8a832ca4a6af7039.jpg'),(183,606,'http://localhost/Azulibre-Rede/uploads/602120cb0f864cac9600e33c137489b5.jpg'),(185,609,'http://localhost/Azulibre-Rede/uploads/e9b944514038b9a625512f7bfc52e283.jpg'),(186,610,'http://localhost/Azulibre-Rede/uploads/a-viuvinha-jose-de-alencar-leni-100029.jpg'),(187,611,'http://localhost/Azulibre-Rede/uploads/f841dfc2afc36567ff9dd057ef781aac.jpg'),(188,612,'http://localhost/Azulibre-Rede/uploads/61dae38bfa0ee15135b4368b1bf972cc.jpg'),(189,613,'http://localhost/Azulibre-Rede/uploads/home-library-office-colour-coded-books-Xenatin.jpg'),(190,614,'http://localhost/Azulibre-Rede/uploads/Caminho-Longo-Vinícius-Fernandes-Irmãos-Livreiros.jpg'),(191,614,'http://localhost/Azulibre-Rede/uploads/51bPc4p9XnL.jpg'),(192,614,'http://localhost/Azulibre-Rede/uploads/41l0ZeWjsgL.jpg'),(193,615,'http://localhost/Azulibre-Rede/uploads/7d783256ac85bf8b1bdcbfed20bcb1b0.jpg'),(194,617,'http://localhost/Azulibre-Rede/uploads/17b49395f9af89db8e897bc751f037bc.jpg'),(195,619,'http://localhost/Azulibre-Rede/uploads/arte_1.png'),(196,619,'http://localhost/Azulibre-Rede/uploads/arte_2.png'),(197,619,'http://localhost/Azulibre-Rede/uploads/arte_3.png');
/*!40000 ALTER TABLE `post_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `post` mediumtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=621 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (601,7,'\"IUB ARAM\" é uma obra fascinante que revela a história de Samuel Pereira, um professor do ensino fundamental de Santa Isabel, São Paulo. Envolvendo referências folclóricas e indígenas, o livro não apenas explora contos conhecidos, mas também introduz uma nova lenda, enriquecendo a herança cultural brasileira. Recomendo a leitura para aqueles que buscam uma conexão mais profunda com as histórias que moldam nossa terra. <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24 (2).jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.24.jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23 (1).jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.23.jpeg\" class=\"gallery-image\"></section>','2023-12-09 21:44:03'),(602,8,'Mentes Poéticas II reune 95 autoras e autores de diversos estados do Brasil e também de Portugal, contando com o olhar atento e crítico do escritor Aleilton Fonseca e da professora Sinéia Maria Teles Silveira, que nos brindaram com o prefácio e o texto para as orelhas, respectivamente. VALE MUITO A PENA, leiam!!! ✨✨✨<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.26.jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25 (1).jpeg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/WhatsApp Image 2023-12-08 at 15.33.25.jpeg\" class=\"gallery-image\"></section>','2023-12-09 21:51:03'),(603,11,'Tarde chuvosa e eu aqui, imerso em um mundo de letras e histórias....','2023-12-09 21:58:38'),(604,12,'Mais um dia, mais uma página escrita. A inspiração não tira férias! A meta é não parar hahaha','2023-12-09 21:59:45'),(605,16,'Café, música e uma boa leitura. A receita perfeita para um final de semana relaxante. ☕️<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/0204128dc387a3cc8a832ca4a6af7039.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:02:08'),(606,19,'Hoje tô na vibe de postar um livro aqui. Mas não sei ainda kkkk será que alguém vai ler? Avaliem com sinceridade, por favor!! Sempre acho q meus livros poderiam melhorar :\\<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/602120cb0f864cac9600e33c137489b5.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:27:46'),(609,21,'Gente, sério, estou impressionado com o talento dessa comunidade! Só tem artista incrível por aqui. Vocês arrasam demais! <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/e9b944514038b9a625512f7bfc52e283.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:41:58'),(610,23,'Esse friozinho pede um bom livro, e nada melhor que um romance clássico. Que tal se perder nas páginas de um José de Alencar?\r\nO escolhido de hoje é \"A Viuvinha\", já disponível em livros, inclusive!! :) Vou ler no kindle haha<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/a-viuvinha-jose-de-alencar-leni-100029.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:44:57'),(611,24,'Desapegando de alguns livros nacionais incríveis! ✨ Quem ama leitura vai adorar essas opções. Todos em ótimo estado. Interessados, chama no direct do insta! @livia_books <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/f841dfc2afc36567ff9dd057ef781aac.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:48:03'),(612,26,'Doando livros para quem ama ler tanto quanto eu! Se interessou por algum título? Manda mensagem no direct que combinamos a entrega. Vamos espalhar o amor pela leitura!! Meu instagram: @helen_rocha91<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/61dae38bfa0ee15135b4368b1bf972cc.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:49:41'),(613,29,'Home office vibes! haha Trabalhando no meu cantinho favorito, acompanhado de um bom livro para os intervalos.<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/home-library-office-colour-coded-books-Xenatin.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:52:25'),(614,32,'Sábado de sol e eu aqui, na minha bolha literária. Simplesmente não saio mais dessa plataforma, help!! kkkk\r\nAproveitando a deixa pra dizer que estou em dúvida entre quais dessa maravilhas NACIONAIS comprar, até porque a representatividade nos livros brasileiros é de suma importância, né?? No fim acho q comprarei os três!<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/Caminho-Longo-Vinícius-Fernandes-Irmãos-Livreiros.jpg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/51bPc4p9XnL.jpg\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/41l0ZeWjsgL.jpg\" class=\"gallery-image\"></section>','2023-12-09 22:55:52'),(615,33,'Às vezes, bate aquela insegurança na hora de compartilhar meus gostos literários... Será que vão gostar? Mas a verdade é que cada livro conta uma história única, assim como cada leitor. Vamos espalhar nossas escolhas e trocar experiências, afinal, a diversidade literária é incrível! <section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/7d783256ac85bf8b1bdcbfed20bcb1b0.jpg\" class=\"gallery-image\"></section>','2023-12-09 23:03:19'),(616,33,'Aliás, estou muito feliz aqui. Me sinto confortável em saber que estou num ambiente que todos prezam pela leitura nacional, a qual é uma luta todos os dias trazer visibilidade. A junção de um feed para dar opiniões, recomendar livros, anunciar vendas/doações juntamente de publicar livros e ler é simplesmente sensacional. \r\n#JuntosPelaLiteraturaBrasileira ','2023-12-09 23:06:54'),(617,34,'Amar é pouco para descrever o que sinto pelos livros brasileiros (que eu sequer sabia da existência) que encontro aqui! Cada história é como uma viagem a um novo mundo, repleto de emoções e descobertas.<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/17b49395f9af89db8e897bc751f037bc.jpg\" class=\"gallery-image\"></section>','2023-12-09 23:11:45'),(618,5,'É uma honra sentir que faço parte de uma comunidade com uma causa tão grande.. a literatura brasileira é magnífica e precisa ser mais vista!!','2023-12-09 23:14:07'),(619,38,'Opa, galera. Queria compartilhar com vocês três imagens que criei recentemente como editor e ilustrador de livros. Estou muito empolgado em fazer parte deste espaço incrível de livros brasileiros e espero que gostem do meu trabalho. Para mais artes me sigam no meu instagram: @cedrick_arts! Além de ilustrações, também já colaborei em capas de livros e estou aqui para trocar experiências e quem sabe colaborar em mais projetos!<section class=\"image-gallery\"><img src=\"http://localhost/Azulibre-Rede/uploads/arte_1.png\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/arte_2.png\" class=\"gallery-image\"><img src=\"http://localhost/Azulibre-Rede/uploads/arte_3.png\" class=\"gallery-image\"></section>','2023-12-10 14:29:55'),(620,39,'Finalmente decidi me juntar a essa incrível comunidade literária que celebra a literatura nacional como ninguém mais! Como amante de romances, estou super empolgada em descobrir tantos autores brasileiros talentosos por aqui. Sempre amei os romances estrangeiros, mas agora estou pronta para mergulhar de cabeça nas histórias apaixonantes que nossa terra tem a oferecer! ✨','2023-12-10 14:37:34');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` mediumtext NOT NULL,
  `ultimo_post` datetime NOT NULL,
  `descricao` mediumtext DEFAULT NULL,
  `img` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'João','joao.silva@gmail.com','$2a$08$NDE4NTcxMTAwNjU3NGZkZO4H8.8R02e5BrvJCMU6PRQzjPykEYhfW','2023-12-09 23:14:07','','65751ec4c4644.jpg'),(6,'Maria','maria.oliv@gmail.com','$2a$08$MTk4MTAyMjEzNDY1NzRmZOoz9SDZcIU03xMbji4jeAujQuJ1UVE4i','2023-12-09 20:53:45','','6575254629daa.jpeg'),(7,'Pedro','pedro.santos@gmail.com','$2a$08$MTEwMDk3NTAyMTY1NzRmZOd4.ufSHt2KKnOgnvscmDPOVTRrEUPum','2023-12-09 21:44:03','Aventureiro das palavras e apaixonado por mundos imaginários! 📚✨ Desbravando cada página com curiosidade e entusiasmo. 🌈❤️','65750a091acf2.jpg'),(8,'Ana','ana.costa@gmail.com','$2a$08$MTU3OTQzMDY1NDY1NzRmZO6Hac4MZrPrRtTGEnEEWAt3KPlI61dAa','2023-12-09 21:51:03','Cada estrofe é um fragmento do meu mundo interior, onde os sentimentos ganham vida e as emoções se transformam em delicadas melodias.','65750c3ded596.jpeg'),(9,'Carlos','carlos.pera@gmail.com','$2a$08$MTQwODcyNzUwNDY1NzRmZOFovs2yHt0eDktmXFsYac3rtM/lMQXbS','2023-12-09 20:55:58','',''),(10,'Beatriz','beatriz.alm@gmail.com','$2a$08$MTg4NDMwNzM5NjY1NzRmZODOsbM9VZFOfqMmG8NUerPb5Sfa/1qLm','2023-12-09 20:56:36','','6575251d3cae8.jpeg'),(11,'Lucas Rocha','lucas.rocha@gmail.com','$2a$08$MTI4NjQ5MjgwNjY1NzRmZOkspeWrhEGL1QtrdAKriXsWeHhz5eD0G','2023-12-09 21:58:38','',''),(12,'Laura','laura.lima@gmail.com','$2a$08$MTc5Mzc0NzI2MTY1NzRmZeQNeu3mxPiA/JoqG6LTXXoyn5nVm/9Lq','2023-12-09 21:59:45','','65750d9ea2c89.jpg'),(13,'Gabriel','gabriel.oliveira@gmail.com','$2a$08$NjgzNzUwMzA4NjU3NGZmMu4gr5ZVlCsGAvz8tVyBuu9KVwPHuXeUa','2023-12-09 20:58:47','','657524b3051b1.jpeg'),(14,'Sofia','sofia.ferndes@gmail.com','$2a$08$MjUyNzAxNjQ0NjU3NGZmN.QCe.iHMN7CyNnzwglQlJkXl9SyssU5y','2023-12-09 20:59:10','','6575255caaf13.jpeg'),(15,'Matheus Peres','matheus.peres@gmail.com','$2a$08$MTUzMDQ4MzA5ODY1NzRmZeiZH61FgiQSwWV2XQQqwrqj1eKeMBbLS','2023-12-09 20:59:50','',''),(16,'Isabela','isabela.rodrigues@gmail.com','$2a$08$MjExNzAyNTU5MTY1NzRmZeAFhAhlVjxuS/70H0aOztAOqAFuZRKei','2023-12-09 22:02:08','','65750e4ae971c.jpg'),(17,'Enzo Carvalho','enzo.carvalho@gmail.com','$2a$08$MTQyNzM5ODU5MjY1NzRmZe/mVrRx6p7rVDWYYyd6uWKd/qNNJa2z2','2023-12-09 21:01:30','',''),(18,'Julia','julia.martins@gmail.com','$2a$08$MTk0ODA2NDcwMTY1NzRmZeH.77pGx1OUkdJKp6zfUYxKsgfP4Zh.a','2023-12-09 21:01:52','','65751219899ff.jpeg'),(19,'Miguel','miguel.lima@gmail.com','$2a$08$MTE4MTg5ODQzODY1NzUwM.S3BosIDu7tbCVsbc2FM5l0iTQSKekLy','2023-12-09 22:27:46','','6575142a376ee.jpeg'),(20,'Manuela Souza','manuela.souza@gmail.com','$2a$08$MTQ3NDM3MTQ5NjU3NTAwMOVc4J/phwv4B2KpYBeLEHMQOUkOuuc6G','2023-12-09 21:02:39','',''),(21,'Leonardo','leonardo.paiva@gmail.com','$2a$08$NTUzMDgxMTAwNjU3NTAwMuxuUk4guDQM325RcerxEI9fzJ.tAlTTS','2023-12-09 22:41:58','','6575177d493be.jpeg'),(22,'Valentina Santos','valent.santos@gmail.com','$2a$08$MzE4ODkxOTY5NjU3NTAwNOH/Etx6NhITP0fuvj3hmg88d80D9jKFa','2023-12-09 21:03:34','',''),(23,'Theo','theo.guedes@gmail.com','$2a$08$OTU5NDU1OTg2NTc1MDA3M.fCMZmJ6zDnOSA4IVV.ERGiyHJsFFM8C','2023-12-09 22:44:57','','65751832383da.jpeg'),(24,'Livia','livia.costa@gmail.com','$2a$08$MTI3NDMwMTkxMDY1NzUwM.TgwT6.x3TZgrZqdp.q2s3QsqG/ngH7u','2023-12-09 22:48:03','','6575189fa0111.jpeg'),(25,'Arthur Almeida','arthur.almeida@gmail.com','$2a$08$MjIwOTU3ODgyNjU3NTAwOO5NdV.0VeWVE128zAxw5V2Z9gO7pzZUu','2023-12-09 21:04:35','',''),(26,'Helena','helena.rocha@gmail.com','$2a$08$MTQyMTM2OTc3MzY1NzUwM.qKj2MW53rmguSaJ5vqSWx3PNrysKASm','2023-12-09 22:49:41','','657519014b994.jpeg'),(27,'Bernardo Nunes','bernardo.nunes@gmail.com','$2a$08$NzI5NzkwODQ5NjU3NTAwYe2Rtbni8ySsQd9.wWLP6NEYN9N0DQ3y.','2023-12-09 21:05:16','',''),(28,'Giovanna Pontes','giovanna.pontes@gmail.com','$2a$08$ODAyNjE1MzE0NjU3NTAwZOsB7NSer7cZEThjbYOKTiWH6napjIgEa','2023-12-09 21:05:55','',''),(29,'Lorenzo','lorenzo.silva@gmail.com','$2a$08$MTYwMzk2MTM4MzY1NzUwM.Ipq6I/8d/czAUCsXEfT8FRRd0tKurRC','2023-12-09 22:52:25','','6575196f9977f.jpeg'),(30,'Gabriele Campos','gabrielecampos@gmail.com','$2a$08$Njg5NzU4OTQzNjU3NTAxMeJJdWflTlc8PWuZcRmrJvRW8lHscJkN6','2023-12-09 21:06:59','',''),(31,'Benjamin. Costa','benjamin.costa@gmail.com','$2a$08$MTM3MzQ5ODYwMDY1NzUwMO./t2QrqbSQU2cK3X2/W3KGO3Fr.6Sqq','2023-12-09 21:07:28','',''),(32,'Cecília','cecilia.almeida@gmail.com','$2a$08$ODg3NDQ5ODcyNjU3NTAxNOb1fD.KCR.nuBjyBn2Qy3Tk6sWgfH6aG','2023-12-09 22:55:52','','65751b1069fd0.jpeg'),(33,'Murilo','murilo.alvares@gmail.com','$2a$08$MjA1NjMzMzYwOTY1NzUwMO0QkcGR7PN7hxOpt0PkmKD3QaThZDBde','2023-12-09 23:06:54','','65751cb49b040.jpeg'),(34,'Eloá','eloa.lima@gmail.com','$2a$08$MzM0ODIyNDk2NTc1MDE4NOEJ..n3BJRtUIr.Jy.iz/SFBAJ03kixK','2023-12-09 23:11:45','','65751deb82383.jpeg'),(37,'Amanda','amanda@gmail.com','$2a$08$MTc2MTQ0MDA5NTY1NzVjN.UXFeMIEXczB0Lu/ztT7b/sHRT.8uh7K','2023-12-10 11:01:20','',''),(38,'Cedrick','cedrickborg@gmail.com','$2a$08$MTgzNTMyNzQ5MDY1NzVmMumCGG3K1G8VzWT5vhuuCkhoZN.MqSqmS','2023-12-10 14:29:55','','6575f53f713f3.jpg'),(39,'Rafaela','rafagoldine@gmail.com','$2a$08$MTk5MjQ4MTg5OTY1NzVmNe5ssaUiL3cr9sJWxyRgql9FpOXxdSHwe','2023-12-10 14:37:34','','6575f71971824.jpg');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-10 16:18:45
>>>>>>> a1bfbc687f9f2a566a53efe25c462d9df81d45a9
