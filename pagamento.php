<?php 
    include "conexao.php"; // Inclui o arquivo de conexão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
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

<h2>Resumo da Compra</h2>
<table>
    <tr> <!-- Cabeçalho da tabela -->
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço</th>
    </tr>
    
    <?php while ($row = $result->fetch_assoc()) {  # Loop para percorrer os resultados
        $total_cart += $row["total"]; # Atualiza o total do carrinho
    ?>
        <tr>
            <td><?php echo $row["nome"]; ?></td>
            <td><?php echo $row["quantidade"]; ?></td>
            <td>R$ <?php echo number_format($row["preco"], 2, ',', '.'); ?></td> <!-- Formata o preço -->
        </tr>
    <?php } ?>
</table>

<h3>Total do Carrinho: R$ <?php echo number_format($total_cart, 2, ',', '.'); ?></h3> <!-- Exibe o total do carrinho -->

</body>
</html>