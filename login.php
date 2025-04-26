<?php
session_start();
include("conexao.php");

$cpf=$_POST["cpf"];
$senha=$_POST["senha"];

if(!isset($_POST['cpf']) || $_POST['cpf'] == ""){
    die("Insira um cpf");
}

if(!isset($_POST['senha']) || $_POST['senha'] == ""){
    die("Insira uma senha");
}

$sql = "select nome from usuarios where cpf = ? and senha = ?";
$stmt = $conn->prepare($sql);

if($stmt){
    $stmt->bind_param("ss", $cpf, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    // Verifica se a consulta retornou resultados
    
    if($result->num_rows > 0){
       $row = $result->fetch_assoc(); 
       if($row['nome'] != ''){
            session_start();
            $_SESSION["cpf"] = $cpf;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $row['nome'];

            header("Location: principal.php");
        }else {
            header("Location: index.php?erro=" . urlencode("CPF ou senha incorretos"));
            exit();
            
    }
    } else {
            die("nenhum usuário encontrado");
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

    <div class="loginin bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-xs">
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