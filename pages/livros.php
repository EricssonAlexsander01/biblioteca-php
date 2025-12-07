<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

// Buscar todos os livros
$sql = "SELECT * FROM livros";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Livros - Biblioteca Futurista</title>
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

        /* Títulos */
        h2 {
            color: cyan;
            text-shadow: 0 0 10px cyan;
            font-weight: bold;
        }

        /* Botões neon */
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

        .btn-neon-warning {
            border-color: #ffd900;
            color: #ffd900;
            font-weight: bold;
            text-shadow: 0 0 10px #ffd900;
            box-shadow: 0 0 15px #ffd900;
            transition: 0.25s;
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

        /* Tabela neon */
        table {
            color: #d8ffff;
        }
        thead {
            background: rgba(0, 200, 255, 0.2);
            border-bottom: 2px solid cyan;
            box-shadow: 0 0 10px cyan;
        }
        tbody tr {
            background: rgba(255, 255, 255, 0.03);
            transition: 0.3s;
        }
        tbody tr:hover {
            background: rgba(0, 200, 255, 0.1);
            box-shadow: inset 0 0 15px cyan;
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
                    <li class="nav-item"><a class="nav-link active" href="livros.php">Livros</a></li>
                    <li class="nav-item"><a class="nav-link" href="emprestimos.php">Empréstimos</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="../logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo -->
    <div class="container my-5 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📚 Lista de Livros</h2>
            <a href="livros_cadastrar.php" class="btn btn-neon">+ Cadastrar Livro</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($livro = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $livro['id'] ?></td>
                            <td><?= $livro['titulo'] ?></td>
                            <td><?= $livro['autor'] ?></td>
                            <td><?= $livro['ano'] ?></td>
                            <td><?= $livro['categoria'] ?></td>
                            <td>
                                <a href="livros_editar.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-neon-warning">Editar</a>
                                <a href="livros_excluir.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-neon-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <a href="painel.php" class="btn btn-neon mt-3">⬅ Voltar ao Painel</a>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-auto">
        © 2025 Biblioteca Futurista Neon
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
