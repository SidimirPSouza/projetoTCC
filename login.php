<?php
            if(isset($_POST['email']) && isset($_POST['senha'])){
                include_once("config.php");
                login($_POST['email'],$_POST['senha']);
            }

           
            ?>
            <!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usúario não Encontrado</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
    display: flex;
    justify-content: center;
    align-items: center;
    background: #ffa726; /* Fundo laranja vibrante */
    color: #333;
    position: relative;
    overflow: hidden;
  }

  .error-container {
    display: flex;
    align-items: center;
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
    max-width: 700px;
    width: 90%; /* Ajuste para ocupar 90% da largura da tela */
    animation: float 3s ease-in-out infinite;
    position: relative;
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

  .btn-back {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background-color: #e53935;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s;
  }

  .btn-back:hover {
    background-color: #d32f2f;
  }

  .overlay-img {
    width: 200px; /* Reduz o tamanho da imagem para dispositivos móveis */
    height: auto;
    margin-bottom: 1rem; /* Espaçamento entre a imagem e o texto */
  }

  .mascote-sobreposicao {
    position: fixed;
    bottom: 20px;
    left: 20px;
    width: 300px; /* Reduz o tamanho do mascote para dispositivos móveis */
    height: auto;
    z-index: 1;
  }

  /* Estilos para o texto de fundo "ERRO" */
  .background-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    color: rgba(255, 255, 255, 0.1);
    font-size: 5rem;
    font-weight: bold;
    z-index: 0;
    pointer-events: none;
  }

  .background-text div {
    position: absolute;
  }

  /* Responsivo: ajustes para telas menores */
  @media (max-width: 600px) {
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

    .overlay-img {
      width: 120px; /* Ajuste da imagem para caber melhor em telas menores */
    }
  }

  /* Animação de flutuação */
  @keyframes float {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-10px);
    }
  }
</style>

</head>

<body>


  <div class="error-container">
    <!-- Imagem do primeiro mascote -->
    <img src="src/images/mascote1.png" alt="Mascote Principal" class="overlay-img">

    <!-- Texto de erro -->
    <div class="error-text">
      <h1>Quem é você?</h1>
      <p>Parece que você não tem um <br>
      cadastro, volte e cadastre-se!</p>
      <a href="index.php" class="btn-back">Voltar para o Login</a>
    </div>
  </div>

 </body>

</html>