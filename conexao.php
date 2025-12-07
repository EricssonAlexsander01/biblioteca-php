<?php
$host = "localhost";
$usuario = "root";       // seu usuário do MySQL
$senha = "";             // sua senha (geralmente vazia no XAMPP)
$banco = "biblioteca";

$con = new mysqli($host, $usuario, $senha, $banco);

if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}
?>
