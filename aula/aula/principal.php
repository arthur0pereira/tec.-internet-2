<?php
session_start();

echo "nome: " . $_SESSION['nome'].'<br>';
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>unifilmes</title>
    
</head>

<body id="conteudo">
    <header>
        <p>Olá</p>

        <div class="sair">
            <button>Sair</button>
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