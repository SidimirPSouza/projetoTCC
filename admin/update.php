<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$nome = $categoria = $preco = $qtde = "";
$nome_err = $categoria_err = $preco_err = $qtde_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["codproduto"]) && !empty($_POST["codproduto"])){
    // Get hidden input value
    $codproduto = $_POST["codproduto"];
    
    // Validate name
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Por favor coloque uma nome.";
    } elseif(!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nome_err = "Por favor coloque uma descrição valida.";
    } else{
        $nome = $input_nome;
    }
    
    // Validate categoria categoria
    $input_categoria = trim($_POST["categoria"]);
    if(empty($input_categoria)){
        $categoria_err = "Please enter an categoria.";     
    } else{
        $categoria = $input_categoria;
    }
    
    // Validate preco
    $input_preco = trim($_POST["preco"]);
    if (empty($input_preco)) {
        $preco_err = "Por favor, insira o valor do preço.";
    } elseif (!filter_var($input_preco, FILTER_VALIDATE_FLOAT)) {
        $preco_err = "Por favor, insira um número válido para o preço.";
    } elseif ($input_preco <= 0) {
        $preco_err = "O preço deve ser maior que zero.";
    } else {
        $preco = $input_preco;
    }
    
    // Validate qtde
    $input_qtde = trim($_POST["qtde"]);
    if (empty($input_qtde)) {
        $qtde_err = "Please enter the quantidade amount.";
    } elseif (!filter_var($input_qtde, FILTER_VALIDATE_FLOAT)) {
        $qtde_err = "Please enter a valid positive number.";
    } elseif ($input_qtde <= 0) {
        $qtde_err = "Please enter a number greater than zero.";
    } else {
        $qtde = $input_qtde;
    }
    
    // Check input errors before inserting in database
    if(empty($nome_err) && empty($categoria_err) && empty($preco_err) && empty($qtde_err)){
        // Prepare an update statement
        $sql = "UPDATE tbprodutos SET nome=?, categoria=?, preco=?, qtde=? WHERE codproduto=?";
         
        if($stmt = mysqli_prepare($conexao, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssdi", $param_nome, $param_categoria, $param_preco, $param_qtde, $param_codproduto);
            
            // Set parameters
            $param_nome = $nome;
            $param_categoria = $categoria;
            $param_preco = $preco;
            $param_qtde = $qtde;
            $param_codproduto = $codproduto;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: vsestoque.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conexao);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["codproduto"]) && !empty(trim($_GET["codproduto"]))){
        // Get URL parameter
        $codproduto =  trim($_GET["codproduto"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tbprodutos WHERE codproduto = ?";
        if($stmt = mysqli_prepare($conexao, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_codproduto);
            
            // Set parameters
            $param_codproduto = $codproduto;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nome = $row["nome"];
                    $categoria = $row["categoria"];
                    $preco = $row["preco"];
                    $qtde = $row["qtde"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conexao);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }

        * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #ff852beb;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 0;
      margin: 0;
      overflow-x: hidden;
      flex-direction: column;
    }

    .container-fluid {
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
      background-color: green;
      border: none;
      border-radius: 5px;
      padding: 0.75rem;
      font-size: 1rem;
      transition: background-color 0.3s;
      font-weight:bold;
    }

    .btn-primary:hover {
      background-color: #c01d28;
    }

    .btn-primary2 {
      width: 100%;
      background-color: red;
      border: none;
      border-radius: 5px;
      padding: 0.75rem;
      font-size: 1rem;
      transition: background-color 0.3s;
      font-weight:bold;
    }

    .btn-primary2:hover {
      background-color: #c01d28;
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Editar produto</h2>
                    <p>Edite os valores do produto e envie para atualizar o registro do funcionário.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                            <span class="invalid-feedback"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select id="categoria" name="categoria" required="required" class="form-control <?php echo (!empty($categoria_err)) ? 'is-invalid' : ''; ?>">
                                <option value="salgados" <?php echo ($categoria == 'salgados') ? 'selected' : ''; ?>>Salgados</option>
                                <option value="doces" <?php echo ($categoria == 'doces') ? 'selected' : ''; ?>>Doces</option>
                                <option value="salgadinhos" <?php echo ($categoria == 'salgadinhos') ? 'selected' : ''; ?>>Salgadinhos</option>
                                <option value="bebidas" <?php echo ($categoria == 'bebidas') ? 'selected' : ''; ?>>Bebidas</option>
                            </select>

                            <span class="invalid-feedback"><?php echo $categoria_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="number" step="0.01" name="preco" class="form-control <?php echo (!empty($preco_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($preco); ?>">
                            <span class="invalid-feedback"><?php echo $preco_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" name="qtde" class="form-control <?php echo (!empty($qtde_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $qtde; ?>">
                            <span class="invalid-feedback"><?php echo $qtde_err;?></span>
                        </div>
                        <input type="hidden" name="codproduto" value="<?php echo $codproduto; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <br><br>
                        <a href="vsestoque.php" class="btn btn-primary2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>