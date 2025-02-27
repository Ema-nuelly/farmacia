<?php 
    include "conexao.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
            <h1>Seja bem-vindo!</h1>
        </nav>
    </header>
    <main>
        <p>Esta é a página inicial do site.</p>
        <?php
            $sql = "SELECT * FROM carrinho";
            $result = $conexao->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>" . $row["codigo"] . "</p>";
                }
            }
        ?>
    </main>
    <footer>
        <p>Site desenvolvido por: <i>Equipe</i></p>
    </footer>
</body>
</html>