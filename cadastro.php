<?php 
    include "conexao.php";
    include('header.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-custom {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            <button type="submit" class="btn-custom">Cadastrar</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('footer.php'); ?>


<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") { // só rodar quando o forms for submetido
    // conectar ao banco de dados
    $host = "localhost";
    $user = "root"; 
    $pass = ""; 
    $dbname = "farmacia";

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // receber os dados do formulário com validação
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
    $senha = isset($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

    if (!$nome || !$email || !$telefone || !$senha) {
        die("Erro: Todos os campos são obrigatórios.");
    }

    // inserir no banco de dados
    $sql = "INSERT INTO clientes (nome, email, telefone, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $telefone, $senha);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    // fechar conexão
    $stmt->close();
    $conn->close();
}
?>

