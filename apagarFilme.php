<?php 
include("conexao.php");

$filme =$_POST['filme'];
$sql = "DELETE FROM filmes WHERE filme = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $filme);
    if ($stmt->execute()) {
                header("Location: cadastroFilmes.php");
        die;
    }else{
        echo'erro';
    }
}
?>