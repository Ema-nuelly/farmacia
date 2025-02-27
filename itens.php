<?php include 'conexao.php'; ?>

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
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT * FROM produto");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$row['nome']}</h5>";
            echo "<p class='card-text'>{$row['bula']}</p>";
            echo "<p class='card-text'><strong>R$ " . number_format($row['preco'], 2, ',', '.') . "</strong></p>";
            echo "<a href='carrinho.php?id={$row['id']}' class='btn btn-primary'>Adicionar ao Carrinho</a>";
            echo "</div></div></div>";
        }
        ?>
    </div>
</div>

</body>
</html>