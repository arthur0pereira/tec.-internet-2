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
    <header class="bg-gradient-to-r from-purple-600 to-blue-500 text-white p-4 flex justify-between items-center shadow-md">
        <p class="text-xl font-semibold">Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</p>
        <a href="logout.php" class="text-white font-bold hover:underline transition">Sair</a>
    </header>

    <div class="flex flex-col md:flex-row max-w-5xl mx-auto mt-10 gap-8">
        <!-- Menu lateral -->
        <aside class="bg-white rounded-xl shadow-lg p-6 w-full md:w-64 mb-6 md:mb-0">
            <h2 class="text-lg font-bold text-purple-700 mb-4">Menu</h2>
            <nav class="flex flex-col gap-3">
                <a href="cadastrarUsuario.php" onclick="carregarPagina('cadastrarUsuario.php'); return false;" class="py-2 px-4 rounded-lg hover:bg-purple-100 text-purple-700 font-medium transition">Cadastrar usuários</a>
                <a href="cadastroFilmes.php" onclick="carregarPagina('cadastroFilmes.php'); return false;" class="py-2 px-4 rounded-lg hover:bg-purple-100 text-purple-700 font-medium transition">Cadastrar filmes</a>
                <!-- <a href="item3.php" onclick="carregarPagina('item3.php'); return false;" class="py-2 px-4 rounded-lg hover:bg-purple-100 text-purple-700 font-medium transition">Item 3</a> -->
            </nav>
        </aside>

        <!-- Conteúdo principal (dinâmico via fetch) -->
        <main class="flex-1 bg-white rounded-xl shadow-lg p-8 min-h-[300px]" id="conteudo-principal">
            <p class="text-gray-500 text-center">Selecione uma opção no menu para começar.</p>
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
