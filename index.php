<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        // O usuário está logado, você pode acessar o nome do usuário a partir do banco de dados ou da sessão
        $user_id = $_SESSION['user_id'];
    
        // Conexão com o banco de dados para buscar o nome do usuário (substitua pelas suas configurações)
        $host = 'localhost';
        $dbname = 'banco_login_cadastro';
        $username = 'root';
        $password = 'Sprtuoe243';
    
        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
            exit();
        }
    
        // Consulta SQL para buscar o nome do usuário
        $stmt = $db->prepare("SELECT nome FROM usuario WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $user_data['nome'];
    } else {
        // O usuário não está logado, redirecione para a página de login
        die("Você não está logado então o conteúdo está oculto!<p><a href=\"log-in.php\">Tela de login</a></p>");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css ">
    <title>Olá Amigo</title>
    
    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: 0;
        font-family: 'KoHo', sans-serif;
    }
    body{
        margin: auto;
        background: linear-gradient(270deg, #F15A5A 36.98%, #BF3352 98.49%);
    }
    .container{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .content{
        width: 650px;
        height: 700px;
        background-color: #fff;
        color: #BF3352;
        border-radius: 4px;
        box-shadow: 1px 5px 35px #000;
    }
    .frase{
        margin: auto;
        width: 100%;
        justify-content: center;
        text-align: center;
        font-size: 45px;
    }
    span{
        line-height: 10px;
        font-size: 50px;
        font-weight: 400;
    }
    a{  
        padding: 2px 4%;
        text-decoration: none;
        font-size: 35px;
        box-shadow: 0px 6px 8px #F15A5A;
        border-radius: 4px;
        color: #BF3352;
    }
    img{
        position: relative;
        width: 350px;
    }
    @media screen and (max-width: 750px) {
        body{
            margin: auto;
        }
        .content{
            padding: 10px 4%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 85%;
        }
        img{
            width: 75%;
        }
        .frase{
            text-align: center;
        }
        .frase h1{
            font-size: 40px;
        }
        .frase span{
            font-size: 35px;
            text-align: justify;
        }
        .frase a{
            font-size: 25px;
        }
    }

    </style>
</head>

<body>

    <main>
        <section>
            <div class="container">

            <div class="content">
                <div class="frase">
                    <h1>Olá <?php echo $nome.'!' ;?><br></h1>
                    <span>Seu login/cadastrado foi executado com sucesso!</span><br>
                    <a href="logout.php"><i class="bi bi-door-open-fill">Aparte para sair!</i></a>
                    <img src="img/hello.png" alt="">
                </div>
            </div>

            </div>
        </section>
    </main>

</body>
</html>