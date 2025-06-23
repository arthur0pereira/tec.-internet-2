<?php

include("autenticacao.php");
include("conexao.php");
include("validaCPF.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];


if (!validaCPF($cpf)) {
    echo "<p style='color:red'>CPF inválido!</p>";
    exit;
}


$sql_check = "SELECT cpf FROM usuarios WHERE cpf = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $cpf);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo "<p style='color:red'>CPF já cadastrado!</p>";
    exit;
}


$sql = "INSERT INTO usuarios (nome, cpf, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $nome, $cpf, $senha);
    if ($stmt->execute()) {
        header("Location: cadastrarusuario.php");
        die;
    } else {
        echo "Erro ao cadastrar usuário.";
        die;
    }
} else {
    echo "Erro na preparação da query.";
    die;
}

?>