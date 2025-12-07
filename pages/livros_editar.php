<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

if (!isset($_GET['id'])) {
    echo "Livro não informado.";
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM livros WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Livro não encontrado!";
    exit();
}

$livro = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo    = $_POST['titulo'];
    $autor     = $_POST['autor'];
    $ano       = $_POST['ano'];
    $categoria = $_POST['categoria'];

    $sql = "UPDATE livros SET titulo = ?, autor = ?, ano = ?, categoria = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisi", $titulo, $autor, $ano, $categoria, $id);

    if ($stmt->execute()) {
        header("Location: livros.php");
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
    <title>Editar Livro - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ESTILO FUTURISTA NEON (MESMO DO OUTRO) -->
    <style>
        body {
            background: radial-gradient(circle at top, #0a0f24, #06080f 70%);
            color: #e4e4e4;
            font-family: "Segoe UI", sans-serif;
        }

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

        /* Card futurista */
        .card-neon {
            background: rgba(255,255,255,0.05);
            padding: 30px;
            border-radius: 18px;
            border: 1px solid rgba(0, 170, 255, 0.25);
            box-shadow: 0 0 25px rgba(0, 170, 255, 0.15);
            backdrop-filter: blur(12px);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            color: #7dd3fc;
            text-shadow: 0 0 10px #009dff;
            font-weight: 700;
        }

        /* Inputs neon */
        .form-control {
            background: rgba(0,0,0,0.35);
            border: 1px solid rgba(0,170,255,0.4);
            color: #e4faff;
            box-shadow: 0 0 10px rgba(0,170,255,0.2);
        }

        .form-control:focus {
            background: rgba(0,0,0,0.45);
            border-color: #00c8ff;
            box-shadow: 0 0 15px #00c8ff;
            color: #fff;
        }

        /* Botão neon */
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

        .btn-voltar {
            border: 1px solid #7dd3fc;
            color: #7dd3fc;
            box-shadow: 0 0 10px rgba(0,170,255,0.3);
        }

        .btn-voltar:hover {
            background: #7dd3fc;
            color: #000;
            box-shadow: 0 0 25px #7dd3fc;
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
            <li class="nav-item"><a class="nav-link" href="emprestimos.php">Empréstimos</a></li>
            <li class="nav-item"><a class="nav-link" href="../logout.php">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Conteúdo -->
    <div class="container d-flex justify-content-center align-items-start my-5 flex-grow-1">

        <div class="card-neon">

            <h2 class="text-center mb-4">✏️ Editar Livro</h2>

            <form method="POST">

                <label class="form-label mt-2">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= $livro['titulo'] ?>" required>

                <label class="form-label mt-3">Autor</label>
                <input type="text" name="autor" class="form-control" value="<?= $livro['autor'] ?>" required>

                <label class="form-label mt-3">Ano</label>
                <input type="text" name="ano" maxlength="4" pattern="\d{4}" class="form-control" value="<?= $livro['ano'] ?>" required>

                <label class="form-label mt-3">Categoria</label>
                <input type="text" name="categoria" class="form-control" value="<?= $livro['categoria'] ?>" required>

                <button type="submit" class="btn btn-neon w-100 mt-4">💾 Salvar Alterações</button>

            </form>

            <a href="livros.php" class="btn btn-voltar w-100 mt-3">⬅ Voltar</a>

        </div>
    </div>

    <footer class="text-white text-center py-3 mt-auto">
        &copy; 2025 Biblioteca Futurista Neon.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
