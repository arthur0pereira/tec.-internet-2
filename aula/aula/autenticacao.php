<?php
session_start();

if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] == ''){
    header("Location: index.php");
    die;
}

if(!isset($_SESSION['senha']) || $_SESSION['senha'] == ''){
    header("Location: index.php");
    die;
}

?>