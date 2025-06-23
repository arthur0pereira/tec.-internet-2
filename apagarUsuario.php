<?php
include("conexao.php");
$cpf = $_POST['cpf'];
$sql = "DELETE FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $cpf);
    if ($stmt->execute()) {
        header("Location: cadastrarUsuario.php");
        die;
    } else {
        echo 'erro';
    }
}
?>