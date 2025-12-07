<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

// Buscar livros para o select
$sqlLivros = "SELECT id, titulo FROM livros ORDER BY titulo";
$livros = $con->query($sqlLivros);

// Quando enviar o formulário:
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $livro_id = $_POST['livro_id'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'];

    // ID do usuário logado
    $usuario_id = $_SESSION['usuario_id'];

    $sql = "INSERT INTO emprestimos (livro_id, usuario_id, data_emprestimo, data_devolucao)
            VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiss", $livro_id, $usuario_id, $data_emprestimo, $data_devolucao);

    if ($stmt->execute()) {
        header("Location: emprestimos.php");
        exit();
    } else {
        echo "Erro ao registrar empréstimo: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Empréstimo - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte futurista -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #0a0f24;
            color: #e2faff;
            font-family: 'Orbitron', sans-serif;
        }

        /* Navbar futurista */
        .navbar {
            background: rgba(0,0,0,0.6) !important;
            border-bottom: 1px solid cyan;
            backdrop-filter: blur(8px);
            box-shadow: 0 0 12px cyan;
        }
        .navbar-brand {
            text-shadow: 0 0 8px cyan;
            font-weight: bold;
        }
        .nav-link {
            color: #b8ffff !important;
        }
        .nav-link:hover, .nav-link.active {
            color: cyan !important;
            text-shadow: 0 0 6px cyan;
        }

        /* Card central */
        .neon-card {
            background: #0d122b;
            border-radius: 15px;
            padding: 35px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 20px cyan;
        }

        h2 {
            color: cyan;
            text-shadow: 0 0 10px cyan;
            font-weight: bold;
        }

        p.text-muted {
            color: #88ffff;
        }

        /* Inputs e selects */
        .form-control, .form-select {
            background: #141b38;
            border: 1px solid #4da8ff;
            color: #fff;
            box-shadow: 0 0 5px #4da8ff;
        }

        .form-control:focus, .form-select:focus {
            border-color: #00ffff;
            box-shadow: 0 0 12px #00ffff;
            background: #1b254d;
            color: #fff;
        }

        /* Botões neon */
        .btn-primary {
            border: 1px solid cyan;
            color: cyan;
            background: transparent;
            text-shadow: 0 0 6px cyan;
            box-shadow: 0 0 12px cyan;
            transition: 0.25s;
        }
        .btn-primary:hover {
            background: cyan;
            color: #000;
            box-shadow: 0 0 20px cyan;
        }

        .btn-secondary {
            border: 1px solid #888;
            color: #fff;
            background: transparent;
            box-shadow: 0 0 8px #888;
            transition: 0.25s;
        }
        .btn-secondary:hover {
            background: #888;
            color: #000;
            box-shadow: 0 0 15px #888;
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
        <a class="navbar-brand" href="painel.php">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="livros.php">Livros</a></li>
            <li class="nav-item"><a class="nav-link active" href="emprestimos.php">Empréstimos</a></li>
            <li class="nav-item"><a class="nav-link" href="../logout.php">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container my-5 flex-grow-1 d-flex justify-content-center align-items-start">
        <div class="neon-card text-center">
            <h2 class="mb-4">Registrar Novo Empréstimo</h2>
            <p class="text-muted mb-4">Selecione o livro e as datas de empréstimo e devolução.</p>

            <form method="POST">
                <div class="mb-3 text-start">
                    <label for="livro_id" class="form-label">Livro</label>
                    <select id="livro_id" name="livro_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php while ($l = $livros->fetch_assoc()) : ?>
                            <option value="<?= $l['id'] ?>"><?= $l['titulo'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3 text-start">
                    <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
                    <input type="date" id="data_emprestimo" name="data_emprestimo" class="form-control" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="data_devolucao" class="form-label">Data de Devolução</label>
                    <input type="date" id="data_devolucao" name="data_devolucao" class="form-control" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Registrar Empréstimo</button>
                </div>
            </form>

            <div class="mt-3">
                <a href="emprestimos.php" class="btn btn-secondary">Voltar à Lista de Empréstimos</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        &copy; 2025 Biblioteca. Todos os direitos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
