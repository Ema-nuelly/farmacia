<?php 

include 'C:\xampp\htdocs\farmacia\base\header.php'; 
?>
<?php 
    error_reporting(E_ALL); // mostrar todos os erros
    ini_set('display_errors', 1); // mostrar todos os erros
    include __DIR__ . '\..\conexao.php'; // incluir arquivo de conexão
    $sql = "SELECT nome, email, telefone FROM clientes WHERE id = ?"; // selecionar o usuário pelo ID
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ+6kF2JhV+T+Mhz9lf8I+O2rhJJcPbNrw9RdbRpk0DXkC0Vr1cuKYfssHlc" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <style>
        .profile-container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .profile-info p {
            margin-bottom: 15px;
            font-size: 16px;
            color: #555;
        }

        @media (max-width: 768px) {
            .profile-container {
                width: 90%;
            }
        }

    </style>
</head>
<body>
    <div class="profile-container container py-5">
        <h1 class="text-center mb-4">Perfil do Usuário</h1>
        <div class="profile-info">
            <p>
                <strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?> <!-- exibir o nome do usuário -->
            </p>
            <p>
                <strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <p><strong>Telefone:</strong> <?php echo isset($usuario['telefone']) ? htmlspecialchars($usuario['telefone']) : 'Não informado'; ?></p> <!-- exibir o telefone do usuário -->
        </div>
        <a href="editar_perfil.php" class="btn btn-success w-100">Editar Perfil</a> <!-- botão NÃO-FUNCIONAL para editar o perfil -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybZi0tL8d5f6aGQ3k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0h4v5+cN7F+Zt6hD9E6Gc7F3DkHz9aGFf5V4COp5wJd/K5L1" crossorigin="anonymous"></script>
</body>
</html>

<?php include 'C:\xampp\htdocs\farmacia\base\footer.php'; ?> <!-- incluir footer -->