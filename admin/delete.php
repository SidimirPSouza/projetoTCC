<?php
// Process delete operation after confirmation
if(isset($_POST["codproduto"]) && !empty($_POST["codproduto"])){
    // Include config file
    require_once "../config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM tbprodutos WHERE codproduto = ?";
    
    if($stmt = mysqli_prepare($conexao, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_codproduto);
        
        // Set parameters
        $param_codproduto = trim($_POST["codproduto"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: vsestoque.php");
            exit();
        } else{
            echo "Oops! Algo deu errado. Tente novamente.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conexao);
} else{
    // Check existence of codproduto parameter
    if(empty(trim($_GET["codproduto"]))){
        // URL doesn't contain codproduto parameter. Redirect to error page
        header("location: ../error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Deletar Produto</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="codproduto" value="<?php echo trim($_GET["codproduto"]); ?>"/>
                            <p>Tem certeza de que deseja excluir este produto?</p>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="vsestoque.php" class="btn btn-secondary">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>