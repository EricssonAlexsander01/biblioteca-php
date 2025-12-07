<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #0f2027, #203a43, #2c5364);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, #1f1c2c, #928dab);
        }

        .card-futuristic {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-futuristic:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 60px rgba(0,0,0,0.7);
        }

        .btn-primary {
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #ffd700;
            color: #000;
            transform: scale(1.05);
        }

        .form-label {
            color: #ffd700;
        }

        a {
            color: #ffd700;
        }

        a:hover {
            text-decoration: underline;
        }

        footer {
            background: linear-gradient(90deg, #1f1c2c, #928dab);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="index.html">📚 Biblioteca</a>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container my-5 flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card-futuristic w-100" style="max-width: 400px;">
            <h2 class="mb-4 text-center">Entrar no Sistema</h2>
            <p class="text-white mb-4 text-center">Digite seu email e senha para acessar sua conta.</p>

            <form action="verificar_login.php" method="POST">
                <div class="mb-3 text-start">
                    <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="senha" class="form-label"><i class="bi bi-lock-fill"></i> Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="index.html"><i class="bi bi-arrow-left-circle"></i> Voltar para a página inicial</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-auto">
        &copy; 2025 Biblioteca. Todos os direitos reservados.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
