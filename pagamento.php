<?php 
    include "conexao.php";
    include('header.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo da Compra</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        table th, table td {
            text-align: center;
            padding: 12px;
        }
        table th {
            background-color: #007bff;
        }
        table td {
            background-color: #f8f9fa;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
$carrinho_id = 1;  // Substitua pelo ID do carrinho desejado

$sql = "SELECT p.nome, p.preco, cp.quantidade, (p.preco * cp. quantidade) AS total # Faz o cálculo do total
        FROM carrinho c
        JOIN carrinho_produto cp ON c.codigo = cp.carrinho_id
        JOIN produto p ON cp.produto_id = p.id
        WHERE c.codigo = $carrinho_id";

$result = $conexao->query($sql); # Executa a consulta

$total_cart = 0; # Inicializa a variável que armazenará o total do carrinho
?>

    <div class="container">
        <h2>Resumo da Compra</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // check if $result contains any rows
                    if ($result->num_rows > 0) {
                        // loop through the result rows
                        while ($row = $result->fetch_assoc()) { 
                            $product_total = $row["quantidade"] * $row["preco"];
                            $total_cart += $product_total;
                ?>
                    <tr>
                        <td><?php echo $row["nome"]; ?></td>
                        <td><?php echo $row["quantidade"]; ?></td>
                        <td>R$ <?php echo number_format($row["preco"], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($product_total, 2, ',', '.'); ?></td> <!-- Display total for the product -->
                    </tr>
                <?php 
                        }
                    } else {
                        echo "<tr><td colspan='3'>Nenhum produto encontrado.</td></tr>";
                    }
                ?>
            </tbody>
        </table>

        <h3 class="total">Total do Carrinho: R$ <?php echo number_format($total_cart, 2, ',', '.'); ?></h3>
    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

