<?php
session_start();

echo "nome: " . $_SESSION['nome'].'<br>';
echo "cpf: " . $_SESSION['cpf'].'<br>';
echo "senha: " . $_SESSION['senha'].'<br>';
?>