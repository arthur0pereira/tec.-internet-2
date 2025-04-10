<?php

session_start();
if (!isset($_SESSION['nome'])) {
    header("Location: login.php"); 
}
$nome = $_SESSION['nome'];
// Verifica se a sessão está iniciada e se o nome está definido

$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
?>


<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_principal.css">
    <title>unifilmes</title>
    
</head>

<body id="conteudo">
    <header>
        <div class="cabecalho">
            <p>Bem Vindo, <?php echo htmlspecialchars($nome);?> !</p> <!-- Exibe o nome -->
        </div>
        <div>
            <a href="">Sair</a>
        </div>
    </header>

    <div>
        <div class="menu">
            <h2>Menu</h2>
            <p>Filme 1</p>
            <p>Filme 2</p>
            <p>Filme 3</p>
        </div>

        <div class="filmes">
            <h2>Em construção...</h2>
        </div>
    </div>

</body>
</html>