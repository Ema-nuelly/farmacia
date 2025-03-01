<?php

include 'conexao.php'; // incluir arquivo de conexão
include 'base/header.php'; // incluir cabeçalho
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
    <h1 class="text-center"><b>Bem-vindo à E-Farma</b></h1>
    <p class="text-center"><i>Veja nossos produtos abaixo.</i></p>

    <div class="row">
        <?php
        $sql = "SELECT * FROM produto"; // selecionar todos os produtos
        $result = $conn->query($sql);  // executar a consulta

        while ($row = $result->fetch_assoc()) { // percorrer os resultados
        ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body d-flex flex-column align-items-center">
                        <?php $caminho = "assets/images/" . htmlspecialchars($row['foto']); ?> <!-- caminho da imagem -->
                        <img src="<?php echo $caminho; ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($row['nome']); ?>" style="max-width: 150px; height: auto;"> <!-- exibir a imagem -->

                        <div class="text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nome']); ?></h5> <!-- exibir o nome do produto -->
                            <p class="card-text"><?php echo htmlspecialchars($row['bula']); ?></p> <!-- exibir a bula do produto -->
                            <p class="card-text"><strong>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></strong></p> <!-- exibir o preço do produto -->

                            <form action="pagamento.php" method="post"> <!-- formulário para adicionar ao carrinho -->
                                <input type="hidden" name="action" value="increase"> <!-- adicionar um item ao carrinho -->
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- ID do produto -->
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

<?php include('base/footer.php'); ?> <!-- incluir o rodapé -->
