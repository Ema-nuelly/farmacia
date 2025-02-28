<?php
session_start(); // iniciar a sessão
$_SESSION = []; // limpar a sessão  
session_destroy();  // destruir a sessão
header("Location: login.php");  // redirecionar para a página de login
exit(); 
?>