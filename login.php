<?php
session_start();
include("conexao.php");

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST["cpf"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if ($cpf == "") {
        $erro = "Insira um CPF";
    } elseif ($senha == "") {
        $erro = "Insira uma senha";
    } else {
        $sql = "select nome from usuarios where cpf = ? and senha = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $cpf, $senha);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['nome'] != '') {
                    $_SESSION["cpf"] = $cpf;
                    $_SESSION["senha"] = $senha;
                    $_SESSION["nome"] = $row['nome'];
                    header("Location: principal.php");
                    exit();
                } else {
                    $erro = "CPF ou senha incorretos";
                }
            } else {
                $erro = "Nenhum usuário encontrado";
            }
        } else {
            $erro = "Erro na consulta ao banco de dados";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UniFilmes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-purple-700 mb-6 text-center">UniFilmes</h1>
        <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Login</h2>
        <?php if ($erro): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="login.php" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded transition duration-200">
                    Entrar
                </button>
            </div>
        </form>
    </div>

</body>
</html>