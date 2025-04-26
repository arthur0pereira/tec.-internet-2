<?php

include("autenticacao.php");
include("conexao.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];


$sql = "insert into usuarios (nome, cpf, senha) values (?, ?, ?)";
$stmt = $conn->prepare($sql);

if($stmt){
    $stmt->bind_param("sss", $nome, $cpf, $senha);
    if($stmt->execute()){}
        header("Location: cadastrarUsuario.php");
        die;
    }else{
        echo "erro ao cadastrar usuario";
        die;
}


?>