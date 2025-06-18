<?php include("autenticacao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen text-gray-800">
    <!-- Cabeçalho -->
    <header class="bg-gradient-to-r from-purple-600 to-blue-500 text-white p-4 flex justify-between items-center shadow-md">
        <a href="principal.php" class="text-white font-bold hover:underline transition">&larr; Voltar</a>
        <h1 class="text-xl font-semibold">Cadastro de Filmes</h1>
        <span></span>
    </header>

    <main class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-purple-700 mb-6 text-center">Cadastrar novo filme</h2>
        <div class="mb-10">
            <?php include("conexao.php") ?>
            <form action="inserirFilme.php" method="post" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <input type="text" name="nome" id="nome" placeholder="Nome"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                </div>
                <div>
                    <input type="text" name="ano" id="ano" placeholder="Ano"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                </div>
                <div>
                    <select name="genero" id="genero"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                        <option value="">Selecione um Gênero</option>
                        <?php
                        $sql = "select * from generos where status=1";
                        if (!$resultado = $conn->query($sql)) {
                            die("erro");
                        }
                        while ($row = $resultado->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['genero_id']; ?>"><?= $row['genero']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="md:col-span-3 flex justify-end">
                    <input type="submit" value="Enviar"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded transition duration-200">
                </div>
            </form>
        </div>

        <h2 class="text-xl font-bold text-purple-700 mb-4">Filmes cadastrados</h2>
        <?php
        include("conexao.php");
        $sql = "select filmes.nome,generos.genero,filmes.ano,filmes.filme, filmes.genero_id from filmes inner join generos on (filmes.genero_id = generos.genero_id)";
        if (!$resultado = $conn->query($sql)) {
            die("erro");
        }
        ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow border">
                <thead>
                    <tr class="bg-purple-100 text-purple-700">
                        <th class="py-2 px-4 text-left">Nome</th>
                        <th class="py-2 px-4 text-left">Gênero</th>
                        <th class="py-2 px-4 text-left">Ano</th>
                        <th class="py-2 px-4 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $resultado->fetch_assoc()) {
                ?>
                    <tr class="border-t hover:bg-gray-50">
                        <form action="./alterarFilme.php" method="post" class="contents">
                            <input type="hidden" name="filme" value="<?= $row['filme']; ?>">
                            <input type="hidden" name="generoId" value="<?= $row['genero_id']; ?>">
                            <td class="py-2 px-4">
                                <input type="text" name="nome" value="<?= $row['nome']; ?>"
                                    class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-1 focus:ring-purple-400">
                            </td>
                            <td class="py-2 px-4">
                                <select name="genero" id="genero"
                                    class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-1 focus:ring-purple-400">
                                    <option value="">Selecione um Gênero</option>
                                    <?php
                                    $sqlGeneros = "select * from generos where status=1";
                                    if (!$resultadoGeneros = $conn->query($sqlGeneros)) {
                                        die("erro");
                                    }
                                    while ($rowGeneros = $resultadoGeneros->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $rowGeneros['genero_id']; ?>"
                                            <?= ($rowGeneros['genero_id'] == $row['genero_id']) ? 'selected' : ''; ?>>
                                            <?= $rowGeneros['genero']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="py-2 px-4">
                                <input type="text" name="ano" value="<?= $row['ano']; ?>"
                                    class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-1 focus:ring-purple-400">
                            </td>
                            <td class="py-2 px-4 flex gap-2">
                                <input type="submit" value="Alterar"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition">
                        </form>
                        <form action="./apagarFilme.php" method="post" class="inline">
                            <input type="hidden" name="filme" value="<?= $row['filme']; ?>">
                            <input type="submit" value="Apagar"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                        </form>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>