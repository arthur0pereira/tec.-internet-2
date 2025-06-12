<?php

include("conexao.php");

$nome = $_POST['nome'];
$ano =$_POST['ano'];
$genero =$_POST['genero'];

$sql = "insert into filmes (filme,nome,genero_id,ano) values (NULL,?,?,?); ";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sii", $nome, $genero, $ano);
    if ($stmt->execute()) {
        header("Location: ./cadastroFilmes.php");

        die;
    } else {
        echo 'erro';
    }
}