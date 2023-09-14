<?php

// Verifica se o usuário está autenticado
include_once "../autenticador.php";

// Incluindo o controlador
include_once "../controllers/receitas.controller.php";

// Verifica se a ação de exclusão foi solicitada
if(isset($_GET['action']) && $_GET['action'] == 'excluir' && isset($_GET['id'])) {

    // Verifica se o usuário é o admin
    if ($_SESSION['usuario_logado'] !== 'admin') {
        echo "Ação restrita ao administrador.";
        exit();
    }

    $idReceita = $_GET['id'];
    unset($_SESSION['receitas'][$idReceita]);
    header('Location: listar.view.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Listar Receitas</title>
    <?php include 'head.php'; ?>
</head>
<body>

<!-- Barra de Navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Sistema de Receitas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="listar.view.php">Listar Receitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adicionar.view.php">Adicionar Receita</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="login.view.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Conteúdo Principal -->
<div class="container mt-5">
    <h1 class="mb-4"><i class="fas fa-utensils"></i> Lista de Receitas</h1>
    
    <!-- Checagem de receitas existentes -->
    <?php if(count($_SESSION['receitas']) == 0): ?>
        <div class="alert alert-warning">
            Nenhuma receita foi adicionada ainda.
        </div>
    <?php else: ?>
        <ul class="list-group">
            <!-- Loop para listar as receitas -->
            <?php foreach($_SESSION['receitas'] as $id => $receita): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="visualizar.view.php?id=<?php echo $id; ?>" class="list-item-link">
                        <?php echo $receita['nome']; ?>
                    </a>
                    <span>
                        <a href="editar.view.php?id=<?php echo $id; ?>" class="btn btn-light btn-sm mr-2" title="Editar Receita"><i class="fas fa-edit"></i></a>
                        <a href="listar.view.php?action=excluir&id=<?php echo $id; ?>" class="btn btn-danger btn-sm" title="Excluir Receita" onclick="return confirm('Tem certeza que deseja excluir esta receita?');"><i class="fas fa-trash-alt"></i></a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<!-- Scripts Bootstrap e jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
