<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $host = 'localhost';
        $dbname = 'banco_login_cadastro';
        $username = 'root';
        $password = 'Sprtuoe243';
        
        // estabelece conexão com o banco de dados
        try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
        echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
        exit();
        }
        $stmt = $db->prepare("SELECT id, nome FROM usuario WHERE email = :email AND senha = :senha");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Login bem-sucedido, armazena o ID do usuário na sessão
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $result['id'];
            
            // Redireciona o usuário para a página "index.php"
            header("Location: index.php");
            exit();
        } else {
            // envia um aviso
            echo '<script> alert("Opa! E-mail e/ou senha estão incorretos.")</script>';
        }

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css ">
    <title>Login</title>
</head>
<body >
    <div class="container"><!-- inicio do container do Login -->
        <div class="content first-content"> <!-- Espaço a ser mostrado -->
            <div class="first-column"><!-- coluna de bem vindo -->
                <h2 class="title title-bem-vindo">Olá amigo(a)!</h2>
                <p class="description">Novo por aqui? realize seu cadastro</p>
                <p class="description">E fique por dentro de tudo!</p>
                <a href="cadastro.php"><button class="btn btn-login">Cadastrar-se</button></a>
            </div><!-- fim da coluna de bem vindo -->
            <div class="second-column"><!-- coluna de cadastro -->
                <h2 class="title">Acesse sua conta!</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#"><i class="bi bi-github"></i></a></li>
                        <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                    </ul>
                </div><!-- social-media -->
                <p class="description">Ou use seu email para logar:</p>
                <form class="form" action="" method="POST">
                    <label for="">E-mail</label>
                    <input type="email" name="email" placeholder="Digite o E-mail cadastrado" required>
                    <label for="">Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                    <button class="btn" type="submit">Entrar</button>
                </form>
            </div><!-- fim do second-column -->
        </div><!-- fim do first-content -->
         </div><!-- fim do container -->
</body>
</html>