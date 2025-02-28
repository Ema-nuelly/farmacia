<?php
session_start(); // Start the session
include '../conexao.php'; // conectar ao banco
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Farmácia</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f4f4f4;">

    <div class="card p-4" style="max-width: 400px; width: 100%; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);">
        <h2 class="text-center mb-4">Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="/farmacia/usuario/cadastro.php">Cadastro</a>
        </div>
        <?php if (isset($_SESSION['erro'])): ?>
            <p class="text-danger text-center mt-2">
                <?php 
                echo $_SESSION['erro'];
                unset($_SESSION['erro']); // limpar erro após exibir
                ?>
            </p>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <p class="text-success text-center mt-2">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']); // Clear the message after displaying it
                ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $sql = "SELECT id, nome, senha FROM clientes WHERE email = ?"; // CHANGE: evita SQL Injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        if (password_verify($senha, $usuario['senha'])) {
            session_start();
            $_SESSION['usuario'] = $usuario['id']; // CHANGE: salva o ID em vez do nome
            header("Location: /farmacia/itens.php");
            exit();
        }
    }

    // erro de login
    $_SESSION['erro'] = "Usuário ou senha incorretos!";
    header("Location: login.php");
    exit();
}
?>
