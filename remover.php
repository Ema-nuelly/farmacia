<?php // LÓGICA DE REMOÇÃO DE PRODUTO DO CARRINHO
session_start(); // iniciar a sessão
include "conexao.php"; // incluir arquivo de conexão

if (isset($_GET['id'])) { // se o ID do produto foi fornecido
    $id = (int)$_GET['id']; // converter para inteiro

    if (isset($_SESSION['carrinho'][$id])) { // se o produto estiver no carrinho
        unset($_SESSION['carrinho'][$id]); // remover do carrinho
    }
}


header("Location: pagamento.php"); // redirecionar para a página de pagamento
exit;
?>