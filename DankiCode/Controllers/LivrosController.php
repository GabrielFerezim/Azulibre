<?php

namespace DankiCode\Controllers;

use DankiCode\Models\LivrosModel;
use PDO;

class LivrosController
{
    private $hostname = 'localhost';
    private $database = 'azulibre_rede';
    private $username = 'root';
    private $password = '';

    public function index()
    {
        
        // Disponibiliza as variáveis para a visão
        $hostname = $this->hostname;
        $bancoDeDados = $this->database;
        $nomeDeUsuario = $this->username;
        $senha = $this->password;
        include('./DankiCode/Views/pages/livros.php');
    }

    public function processarFormulario(LivrosModel $livrosModel, $termo_pesquisa = null)
    {
        $error = '';
        $success = '';
        $info = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['post_livro'])) {
                // Seção de processamento do formulário de postagem de livro
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                $genero = $_POST['genero'];
                $pdfPath = '../Azulibre-Rede/uploads_livros/' . $_FILES['pdfFile']['name'];
                $capaPath = '../Azulibre-Rede/uploads_livros/' . $_FILES['capaFile']['name'];
                $dataHora = date('Y-m-d H:i:s'); // Dados e hora atuais
                $nomeUsuario = $_SESSION['nome']; // Nome do usuário autenticado

                move_uploaded_file($_FILES['pdfFile']['tmp_name'], $pdfPath);
                move_uploaded_file($_FILES['capaFile']['tmp_name'], $capaPath);

                try {
                    $pdo = new PDO("mysql:host={$this->hostname};dbname={$this->database}", $this->username, $this->password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $nomeUsuario = $_SESSION['nome']; // Nome do usuário autenticado A
                    $imgUsuario = $_SESSION['img']; 

                    $info = "Livro POSTADO";

                    $livrosModel->inserirLivroNoBanco($pdo, $titulo, $descricao, $genero, $pdfPath, $capaPath, $nomeUsuario, $dataHora, $imgUsuario);


                    $pdo = null;
                } catch (PDOException $e) {
                    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
                }
                $_POST['error'] = $error;
                $_POST['success'] = $success;
                $_POST['info'] = $info;
            }
        }
    }

    public function pesquisarLivros(LivrosModel $livrosModel, $termo_pesquisa = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['pesquisar_livros'])) {
                // Processar o formulário de pesquisa
                $termo_pesquisa = isset($_POST['termo_pesquisa']) ? $_POST['termo_pesquisa'] : null;
                $resultadosPesquisa = $livrosModel->pesquisarLivros($termo_pesquisa);
            }
        }

        return $resultadosPesquisa ?? [];
    }
}
