<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

// Verifica se recebeu o ID
if (!isset($_GET['id'])) {
    echo "Empréstimo não informado.";
    exit();
}

$id = intval($_GET['id']);

// Buscar dados do empréstimo
$sql = "SELECT * FROM emprestimos WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Empréstimo não encontrado!";
    exit();
}

$emprestimo = $result->fetch_assoc();

// Buscar livros para o select
$sqlLivros = "SELECT id, titulo FROM livros ORDER BY titulo";
$livros = $con->query($sqlLivros);

// Atualizar ao enviar o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $livro_id = $_POST['livro_id'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'];

    $sql = "UPDATE emprestimos SET 
                livro_id = ?, 
                data_emprestimo = ?, 
                data_devolucao = ?
            WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("issi", $livro_id, $data_emprestimo, $data_devolucao, $id);

    if ($stmt->execute()) {
        header("Location: emprestimos.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Empréstimo - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonte futurista -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #0a0f24;
            color: #e2faff;
            font-family: 'Orbitron', sans-serif;
        }

        .navbar {
            background: rgba(0,0,0,0.6) !important;
            border-bottom: 1px solid cyan;
            backdrop-filter: blur(8px);
            box-shadow: 0 0 12px cyan;
        }
        .navbar-brand { text-shadow: 0 0 8px cyan; font-weight: bold; letter-spacing: 2px; }
        .nav-link { color: #b8ffff !important; }
        .nav-link:hover, .nav-link.active { color: cyan !important; text-shadow: 0 0 6px cyan; }

        h2 { color: cyan; text-shadow: 0 0 10px cyan; font-weight: bold; }

        /* Formulário Neon */
        .form-container {
            background: rgba(0,0,0,0.8);
            color: #e2faff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 20px cyan;
        }

        label { font-weight: bold; }

        .btn-neon {
            border: 1px solid cyan;
            color: cyan;
            background: transparent;
            text-shadow: 0 0 6px cyan;
            box-shadow: 0 0 12px cyan;
            transition: 0.25s;
        }
        .btn-neon:hover { background: cyan; color: #000; box-shadow: 0 0 20px cyan; }

        .btn-neon-warning {
            border-color: #ffd900;
            color: #ffd900;
            font-weight: bold;
            text-shadow: 0 0 10px #ffd900;
            box-shadow: 0 0 15px #ffd900;
        }
        .btn-neon-warning:hover {
            background: #ffd900;
            color: #000;
            box-shadow: 0 0 25px #ffd900;
        }

        .btn-neon-danger {
            border-color: #ff4a4a;
            color: #ff4a4a;
            text-shadow: 0 0 6px #ff4a4a;
            box-shadow: 0 0 12px #ff4a4a;
        }
        .btn-neon-danger:hover {
            background: #ff4a4a;
            color: #000;
            box-shadow: 0 0 20px #ff4a4a;
        }

        footer {
            background: rgba(0,0,0,0.5);
            border-top: 1px solid cyan;
            box-shadow: 0 0 12px cyan;
            color: #b8ffff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="painel.php">BIBLIOTECA 2.0</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="livros.php">Livros</a></li>
            <li class="nav-item"><a class="nav-link active" href="emprestimos.php">Empréstimos</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="../logout.php">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Conteúdo -->
    <div class="container my-5 flex-grow-1 d-flex justify-content-center align-items-start">
        <div class="form-container w-100" style="max-width:500px;">
            <h2 class="mb-4 text-center">Editar Empréstimo</h2>
            <p class="text-center text-muted mb-4">Atualize as informações do empréstimo abaixo.</p>

            <form method="POST">
                <div class="mb-3 text-start">
                    <label for="livro_id">Livro</label>
                    <select id="livro_id" name="livro_id" class="form-select" required>
                        <?php while ($l = $livros->fetch_assoc()) : ?>
                            <option value="<?= $l['id'] ?>" <?= $l['id'] == $emprestimo['livro_id'] ? 'selected' : '' ?>>
                                <?= $l['titulo'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3 text-start">
                    <label for="data_emprestimo">Data do Empréstimo</label>
                    <input type="date" id="data_emprestimo" name="data_emprestimo" class="form-control"
                           value="<?= $emprestimo['data_emprestimo'] ?>" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="data_devolucao">Data de Devolução</label>
                    <input type="date" id="data_devolucao" name="data_devolucao" class="form-control"
                           value="<?= $emprestimo['data_devolucao'] ?>" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-neon btn-lg">Salvar Alterações</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="emprestimos.php" class="btn btn-neon mt-2">⬅ Voltar à Lista</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        © 2025 Biblioteca Futurista Neon
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
