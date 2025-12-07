<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

require "../conexao.php";

// Verifica se recebeu o ID
if (!isset($_GET['id'])) {
    echo "Livro não informado.";
    exit();
}

$id = intval($_GET['id']); // segurança

// Executa a exclusão com prepared statement
$sql = "DELETE FROM livros WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: livros.php");
    exit();
} else {
    echo "Erro ao excluir: " . $stmt->error;
}
?>
