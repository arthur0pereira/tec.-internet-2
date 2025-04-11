<?php
session_start();
include("conexao.php");

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    if ($cpf === '' || $senha === '') {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        $cpf = mysqli_real_escape_string($conn, $cpf);
        $senha = mysqli_real_escape_string($conn, $senha);

        $sql = "SELECT nome FROM usuarios WHERE cpf = '$cpf' AND senha = '$senha'";
        $resultado = $conn->query($sql);

        if ($resultado && $row = $resultado->fetch_assoc()) {
            $_SESSION["cpf"] = $cpf;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $row['nome'];
            header("Location: principal.php");
            exit;
        } else {
            $erro = "CPF ou senha incorretos.";
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
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body class="bg-custom flex items-center justify-center">

    <div class="login
in bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-xs">
        <h2 class="text-center text-2xl font-bold mb-4">Login</h2>
        <?php if ($erro): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Entrar</button>
            </div>
        </form>
        </form>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>
