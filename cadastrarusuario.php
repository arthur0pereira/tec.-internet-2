<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen text-gray-800">
    <!-- Cabeçalho -->
    <header class="bg-gradient-to-r from-purple-600 to-blue-500 text-white p-4 flex justify-between items-center shadow-md">
        <a href="principal.php" class="text-white font-bold hover:underline transition">&larr; Voltar</a>
        <h1 class="text-xl font-semibold">Cadastro de Usuários</h1>
        <span></span>
    </header>

    <main class="max-w-3xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-purple-700 mb-6 text-center">Cadastrar novo usuário</h2>
        <form method="post" action="SalvarUsuario.php" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 items-end">
            <div>
                <input type="text" name="cpf" placeholder="CPF"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <div>
                <input type="text" name="nome" placeholder="Nome"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <div>
                <input type="password" name="senha" placeholder="Senha"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>
            <div class="md:col-span-3 flex justify-end">
                <input type="submit" value="Enviar"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded transition duration-200">
            </div>
        </form>
        <?php 
        include("conexao.php");
        $sql = "SELECT nome,cpf,senha FROM usuarios";
        if(!$resultado = $conn->query($sql)){
            die("Error ");
        }
        ?>
        <h2 class="text-xl font-bold text-purple-700 mb-4">Usuários cadastrados</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow border">
                <thead>
                    <tr class="bg-purple-100 text-purple-700">
                        <th class="py-2 px-4 text-left">Nome</th>
                        <th class="py-2 px-4 text-left">CPF</th>
                        <th class="py-2 px-4 text-left">Senha</th>
                        <th class="py-2 px-4 text-left">Alterar</th>
                        <th class="py-2 px-4 text-left">Apagar</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while($row = $resultado->fetch_assoc()){ ?>
                    <tr class="border-t hover:bg-gray-50">
                        <form method="post" action="alterarUsuario.php" class="contents">
                            <input type="hidden" name="cpfAnterior" value="<?=$row['cpf'];?>">
                            <td class="py-2 px-4">
                                <input type="text" name="nome" value="<?=$row['nome'];?>"
                                    class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-1 focus:ring-purple-400">
                            </td>
                            <td class="py-2 px-4">
                                <input type="text" name="cpf" value="<?=$row['cpf'];?>"
                                    class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-1 focus:ring-purple-400">
                            </td>
                            <td class="py-2 px-4">
                                <input type="text" name="senha" value="<?=$row['senha'];?>"
                                    class="w-full px-2 py-1 border rounded focus:outline-none focus:ring-1 focus:ring-purple-400">
                            </td>
                            <td class="py-2 px-4">
                                <input type="submit" value="Alterar"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition">
                            </td>
                        </form>
                        <form method="post" action="apagarUsuario.php" class="inline">
                            <input type="hidden" name="cpf" value="<?=$row['cpf'];?>">
                            <td class="py-2 px-4">
                                <input type="submit" value="Apagar"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                            </td>
                        </form> 
                    </tr>
                <?php
                } 
                ?>
                </tbody>
            </table>
        </div>
    </main>