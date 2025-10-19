<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud";

$conexao = new mysqli($host, $user, $pass, $db);
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}
