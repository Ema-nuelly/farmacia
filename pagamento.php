<?php 

    include "conexao.php"; // incluir o arquivo de conexão com o banco de dados
    include('base/header.php'); // incluir o cabeçalho da página
    $total_cart = 0; // inicializar a variável que armazenará o total do carrinho

    if (isset($_SESSION['carrinho'])) { // verificar se o carrinho existe na sessão
        foreach ($_SESSION['carrinho'] as $item) { // percorrer os itens do carrinho
            $total_cart += $item['preco'] * $item['quantidade']; // calcular o total do carrinho
        }
    }

    
    if (!isset($_SESSION['carrinho'])) { // verificar se o carrinho ainda existe na sessão
        $_SESSION['carrinho'] = []; // criar um carrinho vazio
    }


    if (isset($_POST['action']) && isset($_POST['id'])) { // verificar se o formulário foi submetido
        $id = (int)$_POST['id'];  // obter o ID do produto

        $stmt = $conn->prepare("SELECT * FROM produto WHERE id = ?"); // preparar a consulta
        $stmt->bind_param("i", $id); // vincular o parâmetro
        $stmt->execute([$id]); // executar a consulta
        $result = $stmt->get_result(); // obter o resultado
        $product = $result->fetch_assoc(); // obter o produto

        if ($_POST['action'] == 'increase') { // verificar se o botão de adicionar foi clicado
            if (!isset($_SESSION['carrinho'][$id])) { // verificar se o produto já está no carrinho
                $_SESSION['carrinho'][$id] = [ // adicionar o produto ao carrinho
                    'nome' => $product['nome'],  // obter o nome do produto
                    'preco' => $product['preco'],  // obter o preço do produto
                    'quantidade' => 0, // adicionar um item ao carrinho
                ];
            }
            $_SESSION['carrinho'][$id]['quantidade']++; // adicionar um item ao carrinho
        } elseif ($_POST['action'] == 'decrease' && $_SESSION['carrinho'][$id]['quantidade'] > 1) { // verificar se o botão de remover foi clicado
            $_SESSION['carrinho'][$id]['quantidade']--; // remover um item do carrinho
        }
        header("Location: pagamento.php"); // redirecionar para a página de pagamento
        exit;
    }

    
    if (isset($_GET['action']) && isset($_GET['id'])) { // verificar se a ação e o ID do produto foram enviados por GET
        $id = (int)$_GET['id']; // obter o ID do produto
        
        if ($_GET['action'] == 'increase') { // aumentar a quantidade
            $_SESSION['carrinho'][$id]['quantidade']++; // adicionar um item ao carrinho
        } 
        
        elseif ($_GET['action'] == 'decrease' && $_SESSION['carrinho'][$id]['quantidade'] > 1) { // diminuir a quantidade
            $_SESSION['carrinho'][$id]['quantidade']--; // remover um item do carrinho
        }
        header("Location: pagamento.php"); // redirecionar para a página de pagamento
        exit;
    }

?>
    

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo da Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            flex-wrap: nowrap; 
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            gap: 10px; 
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .item-name {
            flex: 2 1 200px; 
            max-width: 200px; 
            overflow: hidden; 
            word-wrap: break-word; 
            white-space: normal; 
            text-align: left; 
        }
        .item-qty, .item-price, .item-total {
            flex: 1 1 auto; 
            text-align: center; 
        }

        .remove-btn {
            color: #e74c3c;
            cursor: pointer;
            margin-left: 10px;
        }
        .remove-btn:hover {
            color: #c0392b;
        }
        .total {
            font-weight: bold;
            font-size: 1.5em;
            margin-top: 20px;
            text-align: right;
            color: #333;
        }
        .btnP {
            display: inline-block;
            width: 48%;
            padding: 10px 20px;
            margin-top: 20px;
            text-align: center;
            font-size: 1.1em;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .cart-container {
            margin-bottom: 20px;
        }
        .quantity-btns {
            flex: 0 0 auto; 
            display: flex;
            align-items: center;
            gap: 5px; 
        }
        .quantity-btns button {
            padding: 3px 15px;
            margin: 0 5px;
            font-size: 1.2em;
            color: #fff;
            background-color: #218838;
            border-radius: 20%;
            border: none;
            text-decoration: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }
        .quantity-btns button:hover {
            background-color: #0056b3;
        }
        .quantity-btns button:active {
            background-color: #004085;
        }
        @media (max-width: 767.98px) {
        .cart-item {
            flex-direction: column; 
            align-items: flex-start; 
            gap: 10px; 
        }

        .item-name, .item-qty, .item-price, .item-total {
            flex: 1 1 100%;
            text-align: left; 
            max-width: 100%;
        }

        .quantity-btns {
            width: 100%; 
            justify-content: flex-start; 
        }
    }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Cestinha de Compras</h2>

    <div class="cart-container">
        <?php if (!empty($_SESSION['carrinho'])): ?> <!-- verificar se o carrinho não está vazio -->
            <?php foreach ($_SESSION['carrinho'] as $id => $item): ?> <!-- percorrer os itens do carrinho -->                <div class="cart-item">
                    <span class="item-name fw-bold"><?php echo $item["nome"]; ?></span> <!-- exibir o nome do produto -->
                    <span class="item-qty">
                        Quantidade: 
                        <strong>
                            <?php echo $item["quantidade"]; ?> <!-- exibir a quantidade do produto -->
                        </strong>
                        
                    </span>
                    <span class="item-price">
                        Unidade: 
                        <strong>
                            R$ <?php echo number_format($item["preco"], 2, ',', '.'); ?> <!-- exibir o preço do produto -->
                        </strong>
                    </span>
                    <span class="item-total">
                        Total: 
                        <strong>
                            R$ <?php echo number_format($item["quantidade"] * $item["preco"], 2, ',', '.'); ?> <!-- exibir o preço total do produto -->
                        </strong>
                    </span>

                    <div class="quantity-btns">
                        <form action="pagamento.php" method="post">
                            <input type="hidden" name="action" value="decrease">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- enviar o ID do produto -->
                            <button type="submit">-</button> 
                        </form>
                        <form action="pagamento.php" method="post">
                            <input type="hidden" name="action" value="increase">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- enviar o ID do produto -->
                            <button type="submit">+</button>
                        </form>
                        <a href="remover.php?id=<?php echo $id; ?>" class="remove-btn"> <!-- enviar o ID do produto para remover -->
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
            <p class="total">Total: R$ <?php echo number_format($total_cart, 2, ',', '.'); ?></p> <!-- exibir o total do carrinho -->
        <?php else: ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>

    <a href="itens.php" class="btnP btn-secondary">Continuar Comprando</a>
    <a href="checkout.php" class="btnP btn-success">Finalizar Compra</a>
</div>

</body>
</html>

<?php include('base/footer.php'); ?>