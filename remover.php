<?php
session_start();
include "conexao.php";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
}

// Redirect back to pagamento.php
header("Location: pagamento.php");
exit;
?>