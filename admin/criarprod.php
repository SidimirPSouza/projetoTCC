<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <title>Registrar Produtos</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f6f6f6;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 0;
      margin: 0;
      overflow-x: hidden;
      flex-direction: column;
    }

    .container {
      max-width: 500px;
      width: 100%;
      padding: 2rem;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 1;
      margin: 2rem 0;
    }

    h1 {
      text-align: center;
      color: #ff852beb;
      margin-bottom: 1.5rem;
      font-size: 1.75rem;
      font-weight: 600;
    }

    .form-group label {
      font-weight: 500;
      color: #333;
    }

    select.form-control {
  white-space: nowrap; /* Impede o texto de quebrar em várias linhas */
  overflow: hidden; /* Esconde qualquer texto que exceda o campo */
  text-overflow: ellipsis; /* Adiciona "..." ao final se o texto for muito longo */
  padding-right: 2rem; /* Garante espaço interno suficiente no lado direito */
}

    .form-control {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 0.8rem;
    }

    .input-group-text {
      background-color: #ff852beb;
      color: white;
    }

    .form-control::placeholder {
      color: #bbb;
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

    /* Ondas decorativas */
    .wave {
      width: 100%;
      height: 150px;
      overflow: hidden;
      line-height: 0;
    }

    .wave-top {
      position: relative;
      top: 0;
      transform: rotate(180deg);
    }

    .wave-bottom {
      position: relative;
      margin-top: auto;
    }

    .wave svg {
      position: relative;
      display: block;
      width: calc(135% + 1.3px);
      height: 100%;
    }

    .wave svg path {
      fill: #ff6500;;
    }

    /* Responsividade */
    @media (max-width: 576px) {
      .container {
        max-width: 95%;
        padding: 1rem;
        box-shadow: none;
        border-radius: 5px;
      }

      h1 {
        font-size: 1.5rem;
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

  <!-- Onda Superior -->
  <div class="wave wave-top">
    <svg viewBox="0 0 500 150" preserveAspectRatio="none">
      <path d="M0.00,49.98 C153.22,136.36 349.30,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
    </svg>
  </div>

  <div class="container">
    <h1>Registrar Produto</h1>
    <form name="produtos" method="POST" action="criarprod.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nome">Nome</label>
        <input id="nome" name="nome" placeholder="Digite o nome do produto" type="text" required="required" class="form-control">
      </div>
      <div class="form-group">
        <label for="preco">Preço</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">R$</span>
          </div>
          <input id="preco" name="preco" type="text" required="required" class="form-control" placeholder="00,00">
        </div>
      </div>
      <div class="form-group">
        <label for="qtde">Quantidade</label>
        <input id="qtde" name="qtde" type="text" required="required" class="form-control" placeholder="Ex: 10">
      </div>
      <div class="form-group">
        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria" required="required" class="form-control">
                <option value="salgados">Salgados</option>
                <option value="doces">Doces</option>
                <option value="diversos">Diversos</option>
                <option value="bebidas">Bebidas</option>
        </select>
      </div>
      <div class="form-group">
        <label for="imagem">Foto do Item</label>
        <input id="imagem" name="imagem" type="file" class="form-control-file" required="required">
      </div>
      <div class="form-group">
        <button name="submit" type="submit" class="btn btn-primary">Registrar</button>
      </div>
    </form>
    
    <?php
    if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['qtde']) && isset($_POST['categoria']) && ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagem'])) ) {


 
     
        // Define a pasta onde a imagem será salva
        $diretorio = 'img/';

        // Verifica se a pasta 'img' existe, senão cria a pasta
        if (!is_dir($diretorio)) {
          mkdir($diretorio, 0777, true);
        }

        // Recebe o arquivo enviado
        $arquivo = $_FILES['imagem'];

        // Verifica se não houve erro no envio do arquivo
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
          die("Erro no upload: " . $arquivo['error']);
        }

        // Obtém as informações sobre o arquivo
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $extensao = strtolower($extensao); // Converte para minúsculo para uniformizar

        // Define as extensões permitidas
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

        // Verifica se a extensão do arquivo é válida
        if (!in_array($extensao, $extensoesPermitidas)) {
          die("Tipo de arquivo não permitido. Apenas imagens JPG, PNG e GIF são aceitas.");
        }

        // Gera um nome aleatório para a imagem
        $nomeAleatorio = uniqid('img_', true) . '.' . $extensao;

        // Caminho completo onde a imagem será salva
        $caminhoDestino = $diretorio . $nomeAleatorio;

        // Move o arquivo para a pasta de destino
        if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
          
        } else {
          echo "Erro ao mover o arquivo para o diretório de destino.";
        }

        $nome = $_POST['nome'];
      $preco = $_POST['preco'];
      $qtde = $_POST['qtde'];
      $categoria = $_POST['categoria'];



      $campos = [
        "nome"  => "'$nome'",
        "preco"   => "'$preco'",
        "qtde"   => "'$qtde'",
        "categoria"   => "'$categoria'",
        "foto" => "'$nomeAleatorio'"
      ];

      include_once("../config.php");

      cadastrarprod("tbprodutos", $campos);

      } else {
        echo "Nenhuma imagem foi enviada.";
      }
      
    
    ?>

  </div>

  <!-- Onda Inferior -->
  <div class="wave wave-bottom">
    <svg viewBox="0 0 500 150" preserveAspectRatio="none">
      <path d="M0.00,49.98 C153.22,136.36 349.30,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
    </svg>
  </div>

  <!-- Acessibilidade -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

</body>

</html>