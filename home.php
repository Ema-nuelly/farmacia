<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['usuario'])) {
    // Redirect to login page if not logged in
    header("Location: usuario/login.php");
    exit();
}

include 'conexao.php'; // Include the database connection

// Fetch user details from the database
$userId = $_SESSION['usuario']; // Get the logged-in user's ID
$sql = "SELECT nome, email FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc(); // Fetch user data
} else {
    die("Erro: Usuário não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - Farmácia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="home-container">
        <h2>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h2>
        <p>Seu e-mail: <?php echo htmlspecialchars($usuario['email']); ?></p>
        <a href="logout.php"><button>Sair</button></a>
    </div>
</body>
</html>