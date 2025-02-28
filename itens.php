<?php
include 'conexao.php';
include 'base/header.php';
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmácia Online</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Bem-vindo à Farmácia Online</h1>
    <p class="text-center">Veja nossos produtos abaixo.</p>

    <div class="row">
        <?php
        $sql = "SELECT * FROM produto";
        $result = $conn->query($sql); 

        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body d-flex flex-column align-items-center">
                        <?php $caminho = "assets/images/" . htmlspecialchars($row['foto']); ?>
                        <img src="<?php echo $caminho; ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($row['nome']); ?>" style="max-width: 150px; height: auto;">

                        <div class="text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nome']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['bula']); ?></p>
                            <p class="card-text"><strong>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></strong></p>

                            <!-- Form to add to cart -->
                            <form action="pagamento.php" method="post">
                                <input type="hidden" name="action" value="increase">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>

<?php include('footer.php'); ?>
