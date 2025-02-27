<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmacia";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
  die("Conexão falhou: " . $conexao->connect_error);
} else {
  echo "<p style='display: none;'>Conexão realizada com sucesso!</p>";
}
?>