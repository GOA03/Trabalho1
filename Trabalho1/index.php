<?php
// Verificando o status da sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificando se o usuário está autenticado
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    // Se autenticado, redireciona para a lista de receitas
    header('Location: views/listar.view.php');
    exit();
} else {
    // Se não estiver autenticado, redireciona para a página de login
    header('Location: views/login.view.php');
    exit();
}
?>
