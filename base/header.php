<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include 'C:\xampp\htdocs\farmacia\conexao.php'; // incluir arquivo de conexão
    if (!isset($_SESSION['usuario'])) { // se o usuário não estiver logado
        header("Location: usuario/login.php");  // redirecionar para a página de login
        exit();
    }
    


    $userId = $_SESSION['usuario']; // obter o ID do usuário logado
    $sql = "SELECT nome, email, telefone FROM clientes WHERE id = ?"; // selecionar o usuário pelo ID
    $stmt = $conn->prepare($sql); // preparar a consulta
    $stmt->bind_param("i", $userId); // vincular o parâmetro
    $stmt->execute(); // executar a consulta
    $result = $stmt->get_result(); // obter o resultado

    if ($result->num_rows > 0) { // se o usuário foi encontrado
        $usuario = $result->fetch_assoc(); // obter os dados do usuário
    } else {
        die("Erro: Usuário não encontrado."); // exibir mensagem de erro
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Site</title>
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

        /* Header styling */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        /* Logo styling */
        #logo {
            height: 100px;
        }

        @media screen and (max-width: 768px) {
            #logo {
                height: 70px;
            }
        }

        /* Navigation menu styling */
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #f8f9fa;
            text-decoration: underline;
        }

        /* Logout button styling */
        .btn-logout {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #bb2d3b;
        }

        /* Hamburger menu styles */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 4px 0;
            transition: all 0.3s ease;
        }
        #menu {
            z-index: 5;
        }
        @media screen and (max-width: 768px) {
            nav ul {
                flex-direction: column;
                position: absolute;
                top: 100px; 
                right: 0;
                background-color: #0d6efd; 
                width: 100%;
                display: none; 
            }

            nav ul.active {
                display: flex;
            }

            nav ul li {
                margin: 15px 0;
                text-align: center;
            }

            .hamburger {
                display: flex;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white py-3">
        
        <div style="display: flex; justify-content: space-between; width: 100%;">
            <img src="\farmacia\logo.png" id="logo" alt="Logo">
            <div class="hamburger" id="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

       
        <nav>
            <ul id="menu">
                <li><a href="/farmacia/itens.php">Início</a></li>
                <li><a href="/farmacia/pagamento.php">Cestinha</a></li>
                <li>
                    <a href="/farmacia/usuario/perfil.php">
                        <?php echo htmlspecialchars($usuario['nome']); ?> <!-- exibir o nome do usuário -->
                    </a>
                </li>
                <li>
                    <a class="btn-logout" href="/farmacia/usuario/logout.php"> <!-- botão de sair que usa o arquivo logout.php -->
                        Sair
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <script>
    
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');

    
    function closeMenu() {
        menu.classList.remove('active');
    }

    
    hamburger.addEventListener('click', (event) => {
        event.stopPropagation(); 
        menu.classList.toggle('active');
    });

    
    document.addEventListener('click', (event) => {
        const isClickInsideMenu = menu.contains(event.target);
        const isClickOnHamburger = hamburger.contains(event.target);

        
        if (!isClickInsideMenu && !isClickOnHamburger) {
            closeMenu();
        }
    });

    
    const menuItems = menu.querySelectorAll('a');
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            closeMenu();
        });
    });
</script>
</body>
</html>