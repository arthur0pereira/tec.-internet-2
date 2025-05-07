<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

        <div>
            <h2>Cadastrar usuário</h2>
            <form method="post" action="SalvarUsuario.php">
                cpf: <input type="text" name="cpf"><br>
                nome: <input type="text" name="nome"><br>
                senha: <input type="password" name="senha"><br>
                <input type="submit" value="Enviar">
            </form>
            <?php 
            include("conexao.php");

            $sql = "SELECT nome,cpf,senha FROM usuarios";
            if(!$resultado = $conn->query($sql)){
                die("Error ");
            }
            ?>
            <table>
                <tr>
                    <td>nome</td>
                    <td>cpf</td>
                    <td>senha</td>
                    <td>alterar</td>
                    <td>apagar</td>
                </tr>

                <?php 
                while($row = $resultado->fetch_assoc()){ ?>
                    <tr>
                        <form method="post" action="alterarUsuario.php">
                            <input type="hidden" name="cpfAnterior" value="<?=$row['cpf'];?>">
                            <td>
                                <input type="text" name="nome" value="<?=$row['nome'];?>">
                            </td>
                            <td>
                                <input type="text" name="cpf" value="<?=$row['cpf'];?>">
                            </td>
                            <td>
                                <input type="text" name="senha" value="<?=$row['senha'];?>">
                            </td>
                            <td>
                                <input type="submit" value="Alterar">
                            </td>
                        </form>
                        <form method="post" action="apagarUsuario.php">
                            <input type="hidden" name="cpf" value="<?=$row['cpf'];?>">
                            <td>
                                <input type="submit" value="Apagar">
                            </td>
                        </form> 
                    </tr>
                <?php
                } 
                ?>
            </table>
        </div>
    </div>
</body>
</html>