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
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="itens.php">Itens</a></li>
                <li><a href="pagamento.php">Pagamento</a></li>
            </ul>
        </nav>
    </header>
