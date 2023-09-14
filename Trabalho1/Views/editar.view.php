<?php

// Verificar se o usuário está autenticado
include_once "../autenticador.php";

// Verificar se o usuário é o admin
if ($_SESSION['usuario_logado'] !== 'admin') {
    echo "Acesso restrito ao administrador.";
    exit();
}

// Incluindo o controlador
include_once "../controllers/receitas.controller.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $ingredientes = $_POST['ingredientes'] ?? '';
    $modo_preparo = $_POST['modo_preparo'] ?? '';
    $idReceita = $_POST['id'] ?? null;

    // Verificamos se o ID da receita existe
    if ($idReceita && isset($_SESSION['receitas'][$idReceita])) {
        $_SESSION['receitas'][$idReceita] = [
            'nome' => $nome,
            'ingredientes' => $ingredientes,
            'modo_preparo' => $modo_preparo
        ];
        
        header('Location: listar.view.php');
        exit();
    }
}

$id = $_GET['id'] ?? null;
$receita = $_SESSION['receitas'][$id] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Editar Receita</title>
    <?php include 'head.php'; ?>
</head>
<body>

<!-- Formulário de Edição -->
<div class="container mt-5">
    <h1>Editar Receita</h1>
    <form action="editar.view.php" method="post">
        <div class="form-group">
            <label>Nome da Receita</label>
            <input type="text" name="nome" class="form-control" value="<?php echo $receita['nome']; ?>" required>
        </div>
        <div class="form-group">
            <label>Ingredientes</label>
            <textarea name="ingredientes" class="form-control" rows="5" required><?php echo $receita['ingredientes']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Modo de Preparo</label>
            <textarea name="modo_preparo" class="form-control" rows="5" required><?php echo $receita['modo_preparo']; ?></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Campo oculto com o ID da receita -->
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="javascript:history.back()" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i> Voltar</a>
    </form>
</div>

<!-- Scripts Bootstrap e jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
