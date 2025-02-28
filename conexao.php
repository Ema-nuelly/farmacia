<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmacia";

// criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>