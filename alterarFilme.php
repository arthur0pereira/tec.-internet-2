<?php
include("conexao.php");

$filme = $_POST['filme'];
$nome = $_POST['nome'];
$ano = $_POST['ano'];
$generoId = $_POST['genero'];



$sql = "update filmes set nome=?, genero_id=?, ano=? where filme=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siii", $nome, $generoId, $ano, $filme);

if ($stmt) {

    if ($stmt->execute()) {
        header("Location: cadastroFilmes.php");
        die;
    } else {
        echo 'erro';
    }
}