<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

$sql = "SELECT e.id, e.data_emprestimo, e.data_devolucao,
               l.titulo AS livro_nome
        FROM emprestimos e
        JOIN livros l ON e.livro_id = l.id";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empréstimos - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ESTILO FUTURISTA NEON (IGUAL AO ANTERIOR) -->
    <style>

        body {
            background: radial-gradient(circle at top, #0a0f24, #06080f 70%);
            color: #e4e4e4;
            font-family: "Segoe UI", sans-serif;
        }

        /* Navbar */
        .navbar {
            background: rgba(0, 170, 255, 0.15);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 170, 255, 0.4);
        }

        .navbar-brand, .nav-link {
            color: #7dd3fc !important;
            font-weight: 600;
            text-shadow: 0 0 6px #009dff;
        }

        .nav-link:hover {
            color: #fff !important;
            text-shadow: 0 0 10px #00c8ff;
        }

        /* Card neon igual ao anterior */
        .card-table {
            background: rgba(255,255,255,0.05);
            padding: 30px;
            border-radius: 18px;
            border: 1px solid rgba(0, 170, 255, 0.25);
            box-shadow: 0 0 25px rgba(0, 170, 255, 0.15);
            backdrop-filter: blur(12px);
        }

        h2 {
            color: #7dd3fc;
            text-shadow: 0 0 10px #009dff;
            font-weight: 700;
        }

        /* Botão principal neon */
        .btn-neon {
            background: transparent;
            border: 2px solid #00d0ff;
            color: #00eaff;
            font-weight: 600;
            box-shadow: 0 0 12px #00c8ff;
            transition: 0.3s;
        }

        .btn-neon:hover {
            background: #00c8ff;
            color: #000;
            box-shadow: 0 0 25px #00d0ff, 0 0 40px #00aaff;
        }

        /* Tabela neon */
        table {
            color: #e7f9ff;
        }

        thead {
            background: rgba(0, 170, 255, 0.20);
            color: #7dd3fc;
            text-shadow: 0 0 6px #00c8ff;
        }

        tbody tr:hover {
            background: rgba(0, 170, 255, 0.08);
        }

        /* Botão editar — laranja neon */
        .btn-editar {
            background: rgba(255, 170, 0, 0.15);
            border: 1px solid #ffc557;
            color: #ffcf7e;
            font-weight: 600;
            box-shadow: 0 0 10px #ffb42f;
            transition: 0.3s;
        }

        .btn-editar:hover {
            background: #ffb42f;
            color: #000;
            box-shadow: 0 0 25px #ffb42f;
        }

        /* Botão excluir — vermelho neon */
        .btn-danger {
            background: rgba(255, 60, 60, 0.15);
            border: 1px solid #ff4949;
            color: #ff7d7d;
            font-weight: 600;
            box-shadow: 0 0 12px #ff2f2f;
        }

        .btn-danger:hover {
            background: #ff2f2f;
            color: #000;
            box-shadow: 0 0 25px #ff2f2f;
        }

        footer {
            background: rgba(0, 170, 255, 0.15);
            border-top: 1px solid rgba(0, 170, 255, 0.3);
            backdrop-filter: blur(10px);
        }

    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="painel.php">🔷 Biblioteca</a>

        <button class="navbar-toggler bg-info" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
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

    <!-- Conteúdo -->
    <div class="container my-5 flex-grow-1">

        <div class="card-table">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>📘 Gerenciar Empréstimos</h2>
                <a href="emprestimos_cadastrar.php" class="btn btn-neon">➕ Registrar Empréstimo</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Livro</th>
                            <th>Data Empréstimo</th>
                            <th>Data Devolução</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['livro_nome'] ?></td>
                            <td><?= $row['data_emprestimo'] ?></td>
                            <td><?= $row['data_devolucao'] ?></td>

                            <td class="text-center">

                                <a href="emprestimos_editar.php?id=<?= $row['id'] ?>"
                                   class="btn btn-sm btn-editar me-2">
                                   ✏️ Editar
                                </a>

                                <a href="emprestimos_excluir.php?id=<?= $row['id'] ?>"
                                   onclick="return confirm('Deseja excluir este empréstimo?')"
                                   class="btn btn-sm btn-danger">
                                   🗑️ Excluir
                                </a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <a href="painel.php" class="btn btn-neon mt-3">⬅ Voltar</a>

        </div>
    </div>

    <footer class="text-white text-center py-3 mt-auto">
        &copy; 2025 Biblioteca Futurista Neon.
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
