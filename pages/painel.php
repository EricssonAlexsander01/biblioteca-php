<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel - Biblioteca Futurista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0a0f24;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
        }

        /* Navbar futurista */
        .navbar {
            background: rgba(0, 0, 0, 0.6) !important;
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(0, 200, 255, 0.4);
            box-shadow: 0 0 10px rgba(0, 200, 255, 0.5);
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 0 0 8px cyan;
        }
        .nav-link {
            color: #bbfaff !important;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: cyan !important;
            text-shadow: 0 0 6px cyan;
        }

        /* Card central neon */
        .neon-card {
            background: rgba(10, 20, 40, 0.8);
            border: 1px solid rgba(0, 200, 255, 0.4);
            box-shadow: 0 0 20px rgba(0, 200, 255, 0.3);
            border-radius: 16px;
            backdrop-filter: blur(6px);
        }

        /* Botões neon */
        .btn-neon {
            border: 1px solid cyan;
            color: cyan;
            background: transparent;
            text-shadow: 0 0 6px cyan;
            box-shadow: 0 0 10px cyan;
            transition: 0.25s;
        }
        .btn-neon:hover {
            background: cyan;
            color: #000;
            box-shadow: 0 0 20px cyan;
        }

        .btn-neon-primary {
            background: rgba(0, 200, 255, 0.15);
            border: 1px solid cyan;
            color: #81faff;
            box-shadow: 0 0 12px rgba(0, 200, 255, 0.5);
        }
        .btn-neon-primary:hover {
            background: cyan;
            color: #000;
            box-shadow: 0 0 20px cyan;
        }

        /* Footer neon */
        footer {
            background: rgba(0, 0, 0, 0.5);
            border-top: 1px solid cyan;
            box-shadow: 0 0 10px cyan;
        }
    </style>

    <!-- Google Font Futurista -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="../index.php">BIBLIOTECA 2.0</a>
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

    <!-- Conteúdo principal -->
    <div class="container my-5 flex-grow-1 d-flex justify-content-center align-items-start">
        <div class="text-center p-5 neon-card w-100" style="max-width: 650px;">

            <h2 class="mb-4" style="text-shadow: 0 0 8px cyan;">
               👾 Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!
            </h2>

            <p class="mb-4" style="color: #aefbff;">Selecione uma função do sistema.</p>

            <div class="d-grid gap-3">
                <a href="livros.php" class="btn btn-neon-primary btn-lg">📚 Gerenciar Livros</a>
                <a href="emprestimos.php" class="btn btn-neon-primary btn-lg">📄 Gerenciar Empréstimos</a>
                <a href="../logout.php" class="btn btn-neon btn-lg">⛔ Sair</a>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-auto">
        &copy; 2025 Biblioteca Futurista. Sistema Neon.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
