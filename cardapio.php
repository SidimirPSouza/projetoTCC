<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cardápio - Cantina Express</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/styles/styles.css">
    <link rel="stylesheet" href="src/styles/modal.css">
    <style>
        /* Estilos gerais */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            background-color: #f9f7f1; /* Cor de fundo pastel */
        }

        footer {
            margin-top: auto;
            position: relative;
            width: 100%;
        }

        #wave {
            display: block;
            width: 100%;
            height: auto;
        }

        body {
            background-color: #f9f7f1;
            font-family: Arial, sans-serif;
        }

        .hotbar {
            background-color: #e53935;
            color: white;
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .filter-container {
            margin: 1rem;
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 1rem;
        }

        .category-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            padding: 1rem;
            margin: 1rem 0;
        }

        .dish {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            width: 250px;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .dish-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .dish-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .dish-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-top: 1rem;
        }

        .dish-price h4 {
            color: #e53935;
            margin: 0;
        }

        .btn-default {
            padding: 0.5rem;
            border: none;
            background-color: #f0f0f0;
            color: #333;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .btn-default:hover {
            background-color: #ddd;
        }

        .btn-success {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-success:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body onload="filterByCategory()">
    <!-- Cabeçalho -->
    <header>
        <nav id="navbar">
            <i class="fa-solid" id="nav_logo">Cardapio <span style="color: red; font-size: 24px;"> Express</span></i>
            <ul id="nav_list">
                <li class="nav-item active">
                    <a href="index.php">Início</a>
                </li>
                <li class="nav-item b">
                    <a href="carrinho.html">Carrinho</a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Conteúdo principal -->
    <div class="filter-container">
        <label for="category-filter">Filtrar por Categoria: </label>
        <select id="category-filter" onchange="filterByCategory()">
            <option value="all">Todas</option>
        </select>
    </div>

    <div class="container" id="menu-container">
        <?php
        require_once "config.php";

        $categorias = [];
        $sql = "SELECT * FROM tbprodutos WHERE qtde > 0 ORDER BY categoria";
        if ($result = mysqli_query($conexao, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    // Adiciona a categoria no array para preencher o filtro
                    if (!in_array($row["categoria"], $categorias)) {
                        $categorias[] = $row["categoria"];
                    }

                    // Exibe o produto apenas se o estoque for maior que zero
                    ?>
                    <div class="category-container" data-category="<?php echo $row["categoria"]; ?>">
                        <div class="dish">
                            <img src="admin/img/<?php echo $row["foto"]; ?>" class="dish-image" alt="Imagem do prato">
                            <div>
                                <p class="dish-title"><?php echo $row["nome"]; ?></p>
                                <div class="dish-price">
                                    <h4><?php echo $row["preco"]; ?> R$</h4>
                                    <button onclick="increment('<?php echo $row['codproduto']; ?>', <?php echo $row['qtde']; ?>)" class="btn-default">+</button>
                                    <span id="quantity-<?php echo $row['codproduto']; ?>">0</span>
                                    <button onclick="decrement('<?php echo $row['codproduto']; ?>')" class="btn-default">-</button>
                                    <button onclick="addToCart('<?php echo $row['codproduto']; ?>', '<?php echo $row['nome']; ?>', <?php echo $row['preco']; ?>)" class="btn btn-success">Pedir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                mysqli_free_result($result);
            } else {
                echo '<div class="alert alert-danger"><em>Não há produtos disponíveis.</em></div>';
            }
        } else {
            echo "Erro ao carregar os produtos. Tente novamente.";
        }
        mysqli_close($conexao);
        ?>
    </div>

    <script>
        const categorias = <?php echo json_encode($categorias); ?>;
        const categoryFilter = document.getElementById("category-filter");

        // Preenche o seletor de categoria
        categorias.forEach(categoria => {
            const option = document.createElement("option");
            option.value = categoria;
            option.textContent = categoria;
            categoryFilter.appendChild(option);
        });

        function filterByCategory() {
            const selectedCategory = categoryFilter.value;
            const categoryContainers = document.querySelectorAll(".category-container");

            categoryContainers.forEach(container => {
                const category = container.getAttribute("data-category");
                if (selectedCategory === "all" || category === selectedCategory) {
                    container.style.display = "block";
                } else {
                    container.style.display = "none";
                }
            });
        }

        function increment(id, max) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            const currentQuantity = parseInt(quantityElement.textContent);
            if (currentQuantity < max) {
                quantityElement.textContent = currentQuantity + 1;
            } else {
                alert("Quantidade máxima atingida!");
            }
        }

        function decrement(id) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            const currentQuantity = parseInt(quantityElement.textContent);
            if (currentQuantity > 0) {
                quantityElement.textContent = currentQuantity - 1;
            }
        }

        function addToCart(id, name, price) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            const quantity = parseInt(quantityElement.textContent);

            if (quantity > 0) {
                let cart = JSON.parse(localStorage.getItem("cart")) || {};
                cart[id] = { name, price, quantity };
                localStorage.setItem("cart", JSON.stringify(cart));
                alert("Produto adicionado ao carrinho!");
            } else {
                alert("Selecione ao menos uma unidade!");
            }
        }
    </script>
</body>
</html>
