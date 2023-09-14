<?php

// Verificar se o usuário está autenticado
include_once "../autenticador.php";

// Incluindo o controlador de receitas
include_once "../controllers/receitas.controller.php";

$id = $_GET['id'];
$receita = $_SESSION['receitas'][$id] ?? null;

if (!$receita) {
    header('Location: listar.view.php');
}
?>

<!-- HTML para visualizar uma receita -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Visualizar Receita</title>
    <?php include 'head.php'; ?>
</head>
<body>

<!-- Início da barra de navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <!-- Nome da aplicação -->
    <a class="navbar-brand" href="#">Sistema de Receitas</a>

    <!-- Botão de navegação -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Menu de navegação -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            
            <!-- Link para a página que lista as receitas -->
            <li class="nav-item">
                <a class="nav-link" href="listar.view.php">Listar Receitas</a>
            </li>
            
            <!-- Link para a página de adicionar novas receitas -->
            <li class="nav-item">
                <a class="nav-link" href="adicionar.view.php">Adicionar Receita</a>
            </li>
            
            <!-- Link para efetuar o logout, o qual redireciona para login.php com ação de logout -->
            <li class="nav-item">
                <a class="nav-link text-danger" href="login.view.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h1><?php echo $receita['nome']; ?></h1>
    <hr>
    <h4>Ingredientes:</h4>
    <p><?php echo nl2br($receita['ingredientes']); ?></p>
    
    <h4>Modo de Preparo:</h4>
    <p><?php echo nl2br($receita['modo_preparo']); ?></p>

    <a href="editar.view.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Receita</a>
    <a href="listar.view.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>

<!-- Scripts Bootstrap e jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
