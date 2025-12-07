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

$id = intval($_GET['id']); // segurança

// Executa a exclusão
$sql = "DELETE FROM emprestimos WHERE id = $id";

if ($con->query($sql) === TRUE) { // CORRIGIDO
    header("Location: emprestimos.php");
    exit();
} else {
    echo "Erro ao excluir: " . $con->error; // CORRIGIDO
}
?>
