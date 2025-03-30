<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Cadastro</title>
    <style>
        * {
            box-sizing: border-box;
        }

        p { 
          z-index: 1000;
          font-weight: bold;
        }

        body {
            font-family: "sans-serif";
            background-color: #f6f6f6;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .input-group-text i {
    color: #333;
    font-size: 1.2rem;
}

        .container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        h1 {
            text-align: center;
            color: #ff852beb ;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
        }

        .input-group-text {
            cursor: pointer;
        }

        .btn-primary {
            width: 100%;
            background-color: #ff852beb;
            border: none;
            border-radius: 5px;
            padding: 0.75rem;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #c01d28;
        }

        .input-group-append .input-group-text {
            background-color: #ffffff;
            color: white;
        }

        /* Ondas superiores e inferiores */
        .wave {
            position: absolute;
            width: 100%;
            height: 150px;
            overflow: hidden;
            line-height: 0;
        }

        .wave-top {
            top: 0;
            transform: rotate(180deg);
        }

        .wave-bottom {
            bottom: 0;
        }

        .wave svg {
            position: relative;
            display: block;
            width: calc(135% + 1.3px);
            height: 100%;
        }

        .wave svg path {
            fill: #ff6500;
        }

        /* Responsividade */
        @media (max-width: 576px) {
            body {
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            h1 {
                font-size: 1.5rem;
            }

            .container {
                max-width: 95%;
                padding: 1rem;
                box-shadow: none;
                border-radius: 5px;
            }

            .wave {
                height: 100px;
            }
        }

        /* Estilos para o VLibras */
        [vw-access-button] {
            position: fixed;
            bottom: 16px;
            right: 16px;
            z-index: 1000;
        }

        
    </style>
</head>

<body>
  <p id="seta"><</p>
    <!-- Onda Superior -->
    <div class="wave wave-top">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M0.00,49.98 C153.22,136.36 349.30,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
        </svg>
    </div>

    <div class="container">
    <h1>Cadastro de Usuário</h1>
    <form name="usuarios" method="POST" action="cadastro.php">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" placeholder="Digite o seu nome" type="text" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label for="turma">Turma/Função</label>
            <input id="turma" name="turma" placeholder="Digite sua turma/função. EX: 1B1, prof, etc." type="text" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" placeholder="Digite seu email" type="email" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <div class="input-group">
                <input id="senha" name="senha" placeholder="A senha deve conter de 8 a 12 caracteres" type="password" required="required" class="form-control" minlength="8" maxlength="12">
                <div class="input-group-append">
                    <div class="input-group-text" onclick="toggleSenha()">
                        <i class="fa fa-eye-slash" id="olho"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button name="submit" type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

    <?php
    if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome']) && isset($_POST['turma'])) {
        $email = $_POST['email'];
        $s = $_POST['senha'];
        $nome = $_POST['nome'];
        $turma = $_POST['turma'];

        include_once("config.php");

        // Verificação se o e-mail já existe no banco de dados
        $query = "SELECT * FROM tbusuarios WHERE email = '$email'";
        $resultado = mysqli_query($conexao, $query);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<p style='color: red;'>O e-mail já está cadastrado!</p>";
        } else {
            // Caso o e-mail não exista, prossegue com o cadastro
            $dados = [
                "nome" => "'$nome'",
                "turma" => "'$turma'", 
                "email" => "'$email'",
                "senha" => "'$s'",
            ];
            cadastrar("tbusuarios", $dados);
             
            
            
        }
    }
    ?>
</div>


    <!-- Onda Inferior -->
    <div class="wave wave-bottom">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M0.00,49.98 C153.22,136.36 349.30,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
        </svg>
    </div>

    <script>
        function toggleSenha() {
            const senhaInput = document.getElementById("senha");
            const olhoIcon = document.getElementById("olho");
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
                olhoIcon.classList.remove("fa-eye-slash");
                olhoIcon.classList.add("fa-eye");
            } else {
                senhaInput.type = "password";
                olhoIcon.classList.remove("fa-eye");
                olhoIcon.classList.add("fa-eye-slash");
            }
        }
    </script>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>

</html>
