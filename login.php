<?php

// Verifica se o usuário enviou os dados do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Conecta ao banco de dados
    $conn = new PDO('mysql:host=localhost;dbname=nomolde', 'root', '');

    // Seleciona o usuário com o e-mail informado
    $sql = "SELECT * FROM cad_usuario WHERE cad_usuario_nome = '$nome' and cad_usuario_senha = '$senha'";
    $result = $conn->query($sql);

    // Verifica se o usuário existe
    if ($result->rowCount() > 0) {

        // Obtém as informações do usuário
        $usuario = $result->fetchObject();

        // Verifica se a senha informada está correta
        //if (password_verify($senha, $usuario->senha)) {

            // Cria uma sessão para o usuário
            session_start();
            $_SESSION['usuario'] = $usuario;

            // Redireciona o usuário para a página principal
            header('Location: index.php');
            /*
        } else {
            echo '<script>alert("Senha incorreta.");</script>';
        }
        */
    } else {
        echo '<script>alert("Usuário não encontrado.");</script>';
    }
}

?>