<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

// Quando o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo    = $_POST['titulo'];
    $autor     = $_POST['autor'];
    $ano       = $_POST['ano'];
    $categoria = $_POST['categoria'];

    // Usando prepared statement (segurança)
    $sql = "INSERT INTO livros (titulo, autor, ano, categoria)
            VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssis", $titulo, $autor, $ano, $categoria);

    if ($stmt->execute()) {
        header("Location: livros.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro - Biblioteca 2.0</title>
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

        /* NAVBAR FUTURISTA */
        .navbar {
            background: rgba(0, 0, 0, 0.6) !important;
            border-bottom: 1px solid cyan;
            backdrop-filter: blur(8px);
            box-shadow: 0 0 12px cyan;
        }
        .navbar-brand {
            text-shadow: 0 0 8px cyan;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .nav-link {
            color: #b8ffff !important;
        }
        .nav-link:hover {
            color: cyan !important;
            text-shadow: 0 0 6px cyan;
        }

        /* CARD PRINCIPAL */
        .card-neon {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid cyan;
            box-shadow: 0 0 20px cyan;
            color: #e2faff;
        }

        .card-neon h2 {
            color: cyan;
            text-shadow: 0 0 10px cyan;
        }

        /* Inputs futuristas */
        .form-control {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid cyan;
            color: #e2faff;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: cyan;
            box-shadow: 0 0 15px cyan;
            color: #fff;
        }

        /* BOTÕES NEON */
        .btn-neon {
            border: 1px solid cyan;
            color: cyan;
            background: transparent;
            text-shadow: 0 0 6px cyan;
            box-shadow: 0 0 12px cyan;
            transition: 0.25s;
        }
        .btn-neon:hover {
            background: cyan;
            color: #000;
            box-shadow: 0 0 20px cyan;
        }

        .btn-neon-secondary {
            border: 1px solid #8ae2ff;
            color: #8ae2ff;
            text-shadow: 0 0 6px #8ae2ff;
        }
        .btn-neon-secondary:hover {
            background: #8ae2ff;
            color: #000;
            box-shadow: 0 0 20px #8ae2ff;
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
            <li class="nav-item"><a class="nav-link" href="emprestimos.php">Empréstimos</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="../logout.php">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Conteúdo -->
    <div class="container my-5 flex-grow-1 d-flex justify-content-center">
        <div class="card-neon p-5 rounded w-100" style="max-width: 550px;">

            <h2 class="text-center mb-4">Cadastrar Novo Livro</h2>

            <form method="POST">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" id="autor" name="autor" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="text" id="ano" name="ano" maxlength="4" pattern="\d{4}" class="form-control" placeholder="Ex: 2024" required>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" id="categoria" name="categoria" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-neon btn-lg">Cadastrar</button>
                </div>

            </form>

            <div class="text-center mt-4">
                <a href="livros.php" class="btn btn-neon-secondary">⬅ Voltar à Lista</a>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        © 2025 Biblioteca Futurista Neon
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
