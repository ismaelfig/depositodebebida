<!DOCTYPE html>
<html>
<head>
    <title>Página de Venda</title>
</head>
<body>
    <h1>Vender Produtos</h1>
    <a href="produtos.php">Lista de Produtos</a>
    <form action="venda_produtos.php" method="post">
        <label for="produto">Selecione o produto:</label>
        <select name="produto" id="produto">

        <?php
        // Conectar ao banco de dados
        $host = "localhost";
        $db = "deposito_flavio";
        $user = "ismael";
        $pass = "Nick1413@";

        $mysqli = new mysqli($host, $user, $pass, $db);
        if($mysqli->connect_errno) {
            die("falha na conexão com o banco de dados");
        }

        // Buscar os produtos no banco de dados
        $sql = "SELECT id, produto FROM deposito";
        $result = $mysqli->query($sql);

        // Gerar as opções do select
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produtoId = $row['id'];
                $produtoNome = $row['produto'];
                echo "<option value='$produtoId'>$produtoNome</option>";
            }
        }

        // Fechar a conexão com o banco de dados
        $mysqli->close();
        ?>

        </select>
        <br>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade">
        <br>
        <input type="submit" value="Comprar">
    </form>
</body>
</html>
