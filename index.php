<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/styles/styles.css">
    <link rel="stylesheet" href="src/styles/modal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="modal.js" defer></script>
    <script src="visualisar.js" defer></script>
    <title>menu</title>
</head>

<body>


    <style>

#cta h2 {
    font-size: 2.9em;
    font-weight: 700;
    color: #333;
    text-align: center;
    margin-bottom: 10px;
    font-family: Arial, sans-serif;
  }

  #cta .description {
    font-size: 1.3em;
    font-weight: 400;
    color: #666;
    text-align: center;
    line-height: 1.5;
    font-family: Arial, sans-serif;
  }
        /* Estilos da tela de transição */
        #transitionScreen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Garante que sempre ocupe pelo menos 100% da altura da viewport */
            width: 100vw;
            /* Garante que ocupe 100% da largura da viewport */
            background-color: #ffa100;
            /* Cor de fundo */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            opacity: 1;
            transition: opacity 1s ease-out;
            /* Fade out */
        }

        img {
            max-width: 50%;
            /* Define o tamanho da imagem como 50% da largura da tela */
            height: auto;
            /* Mantém a proporção da imagem */
            margin-bottom: 20px;
            /* Espaçamento inferior */
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

       

        .title {font-size: 5px;}
    </style>



    </head>

    


        <header>
            <nav id="navbar">
                <i class="fa-solid" id="nav_logo">Cantina <span style="color: red; font-size: 24px;"> Express</span></i>

                <ul id="nav_list">
                    <li class="nav-item active">
                        <a href="#home">Início</a>
                    </li>
                    <li class="nav-item">
                        <a href="#menu">Categorias </a>
                    </li>
                </ul>
                <?php
                session_start();
                if (isset($_SESSION['email'])) {
                    echo '<a class="btn btn-danger" href="logout.php">Logout</a>';
                } else {
                    echo '<button id="open-modal">Login</button>';
                }

                ?>


                <div id="fade" class="hide"></div>

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


                <div id="transitionScreen">
                    <img src="src/images/download.gif" alt="Cantina Express"> <!-- Mudar imagem da transição de tela -->
                    
                    
        
                </div>


                <div id="mobile_menu">
                    <ul id="mobile_nav_list">
                        <li class="nav-item">
                            <a href="#home">Início</a>
                        </li>
                        <li class="nav-item">
                            <a href="#menu">Cardápio</a>
                        </li>
                    </ul>

                    <a href="cardapio.php"><button class="btn-default">
                            Peça aqui
                        </button></a>
                </div>
        </header>

        <main id="content">
            <section id="home">
                <div class="shape"></div>
                <div id="cta">
                     <h2>
                        Sabores que encantam
                        <br> a um clique de distância!
                    </h2>

                    <p class="description">
                    Seja Bem-Vindo à cantina da escola ETEC Sylvio de Mattos Carvalho!<br>

                    </p>

                    <div id="cta_buttons">
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo '
                        <a href="cardapio.php" class="btn-default">
                            Ver cardápio
                         </a>
                        ';
                        }

                        ?>


                        
                    </div>

                   
                </div>

                <div id="banner">
                    <img src="src/images/logo.png" alt="">
                </div>
            </section>

            <section id="menu">
                <h2 class="section-title">Categorias</h2>
                <h3 class="section-subtitle">Nossas categorias de produtos</h3>

                <div id="dishes">
                    <div class="dish">
                        <div class="dish-heart">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>

                        <img src="src/images/brigadeiro.png" class="dish-image" alt="">

                        <h3 class="dish-title">
                            Doces
                        </h3>

                        <span class="dish-description">
                            Delicie-se com nossa seleção de doces.
                        </span>

                        <div class="dish-price">
                            <h4>Peça aqui</h4>
                            <a href="cardapio.php"><button class="btn-default">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </button></a>
                        </div>
                    </div>

                    <div class="dish">
                        <div class="dish-heart">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>

                        <img src="src/images/coxinha (1).png" class="dish-image" alt="">

                        <h3 class="dish-title">
                            Salgados
                        </h3>

                        <span class="dish-description">
                            Descubra uma seleção irresistível de salgados.
                        </span>

                        <div class="dish-price">
                            <h4>Peça aqui</h4>
                            <a href="cardapio.php"><button class="btn-default">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </button></a>
                        </div>
                    </div>

                    <div class="dish">
                        <div class="dish-heart">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>

                        <img src="src/images/lata-de-bebida.png" class="dish-image" alt="">

                        <h3 class="dish-title">
                            Bebidas
                        </h3>

                        <span class="dish-description">
                            Refresque-se com nossas bebidas.
                        </span>

                        <div class="dish-price">
                            <h4>Peça aqui</h4>
                            <a href="cardapio.php"><button class="btn-default">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </button></a>
                        </div>
                    </div>

                    <div class="dish">
                        <div class="dish-heart">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>

                        <img src="src/images/salgadinhos.png" class="dish-image" alt="">

                        <h3 class="dish-title">
                            Diversos
                        </h3>

                        <span class="dish-description">
                            Procurando algo a mais, entre aqui.
                        </span>

                        <div class="dish-price">
                            <h4>Peça aqui</h4>
                            <a href="cardapio.php"><button class="btn-default">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </button></a>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                

                
                    <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 90" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                                <stop stop-color="rgba(255, 249, 234, 1)" offset="20%"></stop>
                                <stop stop-color="rgba(255, 249, 234, 1)" offset="100%"></stop>
                            </linearGradient>
                        </defs>
                        <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,90L48,81.7C96,73,192,57,288,51.7C384,47,480,53,576,58.3C672,63,768,67,864,66.7C960,67,1056,63,1152,55C1248,47,1344,33,1440,28.3C1536,23,1632,27,1728,35C1824,43,1920,57,2016,56.7C2112,57,2208,43,2304,46.7C2400,50,2496,70,2592,65C2688,60,2784,30,2880,15C2976,0,3072,0,3168,3.3C3264,7,3360,13,3456,28.3C3552,43,3648,67,3744,75C3840,83,3936,77,4032,68.3C4128,60,4224,50,4320,48.3C4416,47,4512,53,4608,61.7C4704,70,4800,80,4896,85C4992,90,5088,90,5184,88.3C5280,87,5376,83,5472,83.3C5568,83,5664,87,5760,86.7C5856,87,5952,83,6048,71.7C6144,60,6240,40,6336,33.3C6432,27,6528,33,6624,38.3C6720,43,6816,47,6864,48.3L6912,50L6912,100L6864,100C6816,100,6720,100,6624,100C6528,100,6432,100,6336,100C6240,100,6144,100,6048,100C5952,100,5856,100,5760,100C5664,100,5568,100,5472,100C5376,100,5280,100,5184,100C5088,100,4992,100,4896,100C4800,100,4704,100,4608,100C4512,100,4416,100,4320,100C4224,100,4128,100,4032,100C3936,100,3840,100,3744,100C3648,100,3552,100,3456,100C3360,100,3264,100,3168,100C3072,100,2976,100,2880,100C2784,100,2688,100,2592,100C2496,100,2400,100,2304,100C2208,100,2112,100,2016,100C1920,100,1824,100,1728,100C1632,100,1536,100,1440,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z">
                        </path>
                    
                    </svg>
                </div>

            </footer>

            <script>
                function showTransition() {
                    setTimeout(() => {
                        const transitionScreen = document.getElementById('transitionScreen');
                        transitionScreen.style.opacity = 0; // Inicia o fade out
                        setTimeout(() => {
                            transitionScreen.style.display = 'none'; // Esconde após o fade out
                            document.getElementById('content').style.display = 'block'; // Mostra o conteúdo principal
                        }, 1000); // Tempo do fade out
                    }, 3000); // Tempo que a tela de transição ficará visível
                }
            </script>

            <body onload="showTransition()">
                <script src="src/javascript/script.js"></script>




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
            <link rel="stylesheet" href="menu.css">

</html>