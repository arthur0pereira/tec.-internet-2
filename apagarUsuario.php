<?php
include("conexion.php");
$cpf = $_POST['cpf'];
$sql = "DELETE * FROM usuarios WHERE cpf = $cpf";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $cpf);
    if ($stmt->execute()) {
        header("Location: cadastro.php");

        die;
    } else {
        echo 'erro';
    }
}
?>