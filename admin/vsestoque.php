<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Estilo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .wrapper {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #ff5722;
            font-weight: bold;
            font-size: 24px;
        }

        .btn-success {
            background-color: #ff5722;
            border-color: #ff5722;
            font-weight: bold;
        }

        .btn-success:hover {
            background-color: #e64a19;
            border-color: #e64a19;
        }

        /* Estilo da tabela */
        .table {
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 16px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .table thead {
            background-color: #ff5722;
            color: #fff;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            font-weight: bold;
        }

        /* Estilo para os ícones de ação */
        .table .fa {
            color: #ff5722;
            font-size: 18px;
        }

        .table .fa:hover {
            color: #e64a19;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .wrapper {
                width: 95%;
            }

            h2 {
                font-size: 20px;
            }

            .btn-success {
                font-size: 14px;
                padding: 8px 16px;
            }

            .table th, .table td {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3 mb-4 clearfix">
                        <h2 class="pull-left">Estoque de Produtos</h2>
                        <a href="criarprod.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Adicionar Produto
                        </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tbprodutos";
                    if($result = mysqli_query($conexao, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Código</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Categoria</th>";
                                        echo "<th>Preço</th>";
                                        echo "<th>Quantidade</th>";
                                        echo "<th>Ações</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['codproduto'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['categoria'] . "</td>";
                                        echo "<td>R$" . number_format($row['preco'], 2, ',', '.') . "</td>";
                                        echo "<td>" . $row['qtde'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="update.php?codproduto='. $row['codproduto'] .'" class="mr-3" title="Editar" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?codproduto='. $row['codproduto'] .'" title="Excluir" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-warning"><em>Nenhum registro encontrado.</em></div>';
                        }
                    } else {
                        echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                    }
                    
                    mysqli_close($conexao);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>