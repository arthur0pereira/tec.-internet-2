<?php

include("conexao.php");
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$cpfantigo = $_POST['cpfAnterior'];

$sql = "UPDATE usuarios set cpf=?,senha=?, nome=? WHERE cpf = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ssss", $cpf, $senha, $nome, $cpfantigo);
    if ($stmt->execute()) {
        header("Location: cadastro.php");

        die;
    } else {
        echo 'erro';
    }
}