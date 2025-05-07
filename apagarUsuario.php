<?php
include("conexion.php");
$cpf = $_POST['cpf'];
$sql = "DELETE * FROM usuarios WHERE cpf = $cpf";
header("Location: cadastro.php");
?>