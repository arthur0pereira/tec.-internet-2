<?php

include("conexao.php");
include("validaCPF.php");

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$cpfantigo = $_POST['cpfAnterior'];

if (!validaCPF($cpf)) {
    echo "<p style='color:red'>CPF inválido!</p>";
    exit;
}

$sql = "UPDATE usuarios set cpf=?,senha=?, nome=? WHERE cpf = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ssss", $cpf, $senha, $nome, $cpfantigo);
    if ($stmt->execute()) {
        header("Location: cadastroUsuario.php");
        die;
    } else {
        echo 'erro';
    }
}