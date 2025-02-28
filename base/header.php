<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['usuario'])) {
    // Redirect to login page if not logged in
    header("Location: usuario/login.php"); 
    exit();
}
include 'C:\xampp\htdocs\farmacia\conexao.php';

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Site</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        footer {
            margin-top: auto;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
        }
        nav ul li a:hover {
            color: #f8f9fa;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1>Farmácia</h1>
        <nav>
            <ul>
                <li><a href="/farmacia/itens.php">Itens</a></li>
                <li><a href="/farmacia/pagamento.php">Pagamento</a></li>
                <li>
                    <a href="/farmacia/usuario/perfil.php">
                        <?php echo htmlspecialchars($usuario['nome']); ?>
                    </a>
                </li>
                <li>
                    <a href="/farmacia/usuario/logout.php">
                        <button class="btn btn-danger btn-sm btn-block">Sair

                        </button>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
