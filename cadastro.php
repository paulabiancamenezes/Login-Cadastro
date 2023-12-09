<?php
    session_start();

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome']; // variável $nome recebe o valor "nome" do input que será preenchido o nome e assim segue a mesma lei para todas as outras variáveis
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $db->prepare("SELECT * FROM usuario WHERE email = :email"); //seleciona e consulta a tabele usuarios na coluna em_email
        $stmt->execute(['email' => $email]); //consulta para ver se já existe email cadastrado igual
        $usuario = $stmt->fetch();

        if ($usuario) {
            // Exibe uma mensagem de erro
            echo '<script> alert("Este e-mail já está sendo usado!")</script>';
          } else {
        
            //Use a função de hash para armazenar a senha de forma segura
            // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
            // Insere o novo usuário no banco de dados
            $stmt = $db->prepare("INSERT INTO usuario
            (nome, email, senha)
             VALUES (:nome, :email, :senha)");
            // $stmt->bindparam("s", $senhaHash);
            $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha]); //executa os valores das variáveis
        
            $_SESSION['user_id'] = $db->lastInsertId(); // Supondo que seu banco de dados gera um ID para o usuário

            // Redirecione o usuário para a página "index.php"
            header("Location: index.php");
            exit();
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
    <title>Cadastro</title>
</head>
<body>
    <div class="container"><!-- inicio do container do Login -->
        <div class="content first-content"> <!-- Espaço a ser mostrado -->
            <div class="first-column"><!-- coluna de bem vindo -->
                <h2 class="title title-bem-vindo">Bem vindo de volta!</h2>
                <p class="description">Para manter conectado conosco</p>
                <p class="description">Por favor execute seu Login</p>
                <a href="log-in.php"><button class="btn">Log-in</button></a>
            </div><!-- fim da coluna de bem vindo -->
            <div class="second-column"><!-- coluna de cadastro -->
                <h2 class="title">Crie sua conta!</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#"><i class="bi bi-github"></i></a></li>
                        <li><a href="#"><i class="bi bi-google"></i></a></li>
                    </ul>
                </div><!-- social-media -->
                <p class="description">Ou use seu email para se registrar</p>
                <form class="form" action="" method="POST">
                    <label for="">Nome</label>
                    <input type="text" name="nome" placeholder="Digite seu nome" required>
                    <label for="">E-mail</label>
                    <input type="email" name="email" placeholder="Digite seu E-mail" required>
                    <label for="">Senha</label>
                    <input type="password" name="senha" placeholder="Crie uma senha" required>
                    <button class="btn" type="submit" >Enviar</button>
                </form>
            </div><!-- fim do second-column -->
        </div><!-- fim do first-content -->
         </div><!-- fim do container -->   
</body>
</html>