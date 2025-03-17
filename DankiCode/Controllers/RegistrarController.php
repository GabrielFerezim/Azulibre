<?php

namespace DankiCode\Controllers;

class RegistrarController 
{
    public function index() 
    {
        $error = '';
        $success = '';

        if (isset($_POST['registrar'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confirmasenha = $_POST['confirmarsenha'];

            if (empty($nome) || empty($email) || empty($senha) || empty($confirmasenha)) {
                $error = "Por favor, preencha todos os campos.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'E-mail Inválido.';
            } else if (strlen($senha) < 6) {
                $error = 'Sua senha é muito curta.';
            } else if ($senha != $confirmasenha) {
                $error = 'Sua senha não está igual.';
            } else if (\DankiCode\Models\UsuariosModel::emailExists($email)) {
                $error = 'Este e-mail já existe no banco de dados!';
            } else {
                $senha = \DankiCode\Bcrypt::hash($senha);
                $registro = \DankiCode\MySql::connect()->prepare("INSERT INTO usuarios (nome, email, senha, ultimo_post, descricao, img) VALUES (?, ?, ?, NOW(), '', '')");
$registro->execute(array($nome, $email, $senha));


                // ...

                $success = 'Registrado com sucesso.';

                // Adicione este bloco ao final do seu código
                // echo '<script>';
                // echo 'setTimeout(function() { window.location.href = "DankiCode/Views/pages/login.php"; }, 2000);'; // Redireciona após 2 segundos
                // echo '</script>';

            }
        }
      
        $_POST['error'] = $error;
        $_POST['success'] = $success;
        \DankiCode\Views\MainView::render('registrar');
    }
}

?>
