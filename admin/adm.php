<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/styles/styles.css">
    <link rel="stylesheet" href="../src/styles/modal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../modal.js" defer></script>
    <script src="../visualisar.js" defer></script>
    <title>Tela do administrador</title>
</head>
<body>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Poppins', sans-serif;
    height: 100vh;
    margin: 0;
    justify-content: center;
    align-items: center;
    
  }

  .error-container {
    display: flex;
    margin: 90px; /* Remove margens para centralização precisa */
    align-items: center;
    justify-content: center; /* Opcional, para centralizar o conteúdo interno */
    background: #fff;
    padding: 2rem;
    border-radius: 40px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
    width: 50%; /* Ajuste para ocupar metade da largura da tela */
    z-index: 2;
    flex-direction: column; /* Alinha o conteúdo em coluna para telas menores */
}

  .error-text {
    margin-left: 1.5rem;
    text-align: center;
  }

  .error-text h1 {
    font-size: 2.5rem;
    color: #e53935;
    margin-bottom: 0.5rem;
  }

  .error-text p {
    font-size: 1.25rem;
    color: #666;
    margin-bottom: 1.5rem;
  }

#cta h2 {
    font-size: 2.9em;
    font-weight: 700;
    color: #333;
    text-align: center;
    margin-bottom: 10px;
    font-family: Arial, sans-serif;
  }

  #cta1 h2{

    font-size: 2.9em;
    font-weight: 700;
    color: green;
    text-align: center;
    margin-bottom: 30px;
    margin-left: 250px;
    font-family: Arial, sans-serif;
  }


  #cta1 .description {
    font-size: 1.3em;
    font-weight: 400;
    color: #666;
    text-align: center;
    line-height: 1.5;
    margin-left: 240px;
    font-family: Arial, sans-serif;
  }

  .error-container {
      max-width: 100%; /* Largura completa no celular */
      padding: 1.5rem; /* Menos padding em dispositivos móveis */
    }

    .error-text h1 {
      font-size: 2rem; /* Reduz o tamanho do texto principal */
    }

    .error-text p {
      font-size: 1rem; /* Reduz o tamanho do parágrafo */
    }
</style>

<header>
<nav id="navbar">
                <i class="fa-solid" id="nav_logo">Quem é <span style="color: red; font-size: 24px;"> você?</span></i>
                <button id="open-modal">Login</button>
            <div id="fade" class="hide"></div>
</nav>
<div id="modal" class="hide">
    <div class="modal-header">
        <h2>Login</h2>
        <button id="close-modal">Fechar</button>
    </div>
    <div class="modal-body">
        <form name="f1" method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" placeholder="Digite seu email..." type="email" class="form-control" required>
                <div id="msgemail"></div>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <div class="input-group">
                    <input id="senha" name="senha" type="password" required class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fa fa-eye-slash" id="olho"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group buttons-group">
                <button name="submit" type="submit" id="login-button">Entrar</button>
                <a href="cadastro.php">
                    <button type="button" id="register-button">Cadastrar</button>
                </a>
            </div>


        </form>
    </div>
</div>
                    
</header>
<main id="content">
<?php 
if (isset($_SESSION['email'])) {
echo '
<a href="criarprod.php" class="btn-default">
    Adicionar produto
</a>
<a href="vsestoque.php" class="btn-default">
    Visualizar estoque
</a>';

}else{
    
echo '
    <div class="error-container">
        <div class="error-text">
        <h1>Quem é você?</h1>
        <p>Parece que você não se conectou <br>
        como adiministrador, conecte-se para acessar os menus!</p>
        </div>
    </div>';
    
}
?>
</div>        

    
</body>
</html>