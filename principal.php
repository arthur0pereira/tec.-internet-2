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
    <title>unifilmes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen text-gray-800">

    <!-- Cabeçalho -->
    <header class="bg-gradient-to-r from-purple-600 to-blue-500 text-white p-4 flex justify-between items-center">
        <p class="text-xl font-semibold">Bem Vindo, <?php echo htmlspecialchars($nome); ?>!</p>
        <a href="logout.php" class="text-white font-bold hover:underline">Sair</a>
    </header>

    <div>
        <div class="menu">
            <h2>Menu</h2>
            <p><a href="cadastrarUsuario.php">Cadastrar usuarios</a></p>
            <p><a href="cadastroFilmes.php">Cadastrar filmes</a></p>
            <p><a href="item3.php">Item 3</a></p>
        </div>

        <!-- Conteúdo principal (dinâmico via fetch) -->
        <main class="flex-1 bg-white rounded-xl shadow-md p-6" id="conteudo-principal">
            <!-- Conteúdo carregado por JavaScript aparecerá aqui -->
        </main>
    </div>

    <!-- Script para carregar páginas -->
    <script>
        function carregarPagina(pagina) {
            fetch(pagina)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("conteudo-principal").innerHTML = html;
                })
                .catch(err => {
                    document.getElementById("conteudo-principal").innerHTML = "<p class='text-red-500'>Erro ao carregar a página.</p>";
                    console.error(err);
                });
        }
    </script>

</body>
</html>
