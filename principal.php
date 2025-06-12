<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit;
}

$nome = $_SESSION['nome'];
?>


<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style_principal.css">
    <title>unifilmes</title>
    
</head>

<body id="conteudo">
    <header>
        <div class="cabecalho">
            <p>Bem Vindo, <?php echo htmlspecialchars($nome);?> !</p> <!-- Exibe o nome -->
        </div>
        <div>
        <a href="logout.php">Sair</a>
        </div>
    </header>

    <div>
        <div class="menu">
            <h2>Menu</h2>
            <p><a href="cadastrarUsuario.php">Cadastrar usuarios</a></p>
            <p><a href="cadastroFilmes.php">Cadastrar filmes</a></p>
            <p><a href="item3.php">Item 3</a></p>
        </div>

        <div class="filmes">
            <h2>Em construção...</h2>
        </div>
    </div>

</body>
</html>

