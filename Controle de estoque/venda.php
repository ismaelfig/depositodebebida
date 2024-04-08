<?php
// Conectar-se ao banco de dados
include('conexao.php');

// Buscar os produtos no banco de dados
$sql = "SELECT id, produto FROM deposito";
$result = $mysqli->query($sql);
?>

<!-- Formulário de venda -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Página de Venda</title>
    <link rel="stylesheet" href="venda.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        // Função para redirecionar para a página de login
        function redirectToLogin() {
            window.location.href = "index.html";
        }

        // Definir tempo limite de inatividade (em milissegundos)
        var inactivityTimeout = 300000; // 5 minutos (300.000 milissegundos)

        // Definir o temporizador de inatividade
        var inactivityTimer = setTimeout(redirectToLogin, inactivityTimeout);

        // Reiniciar o temporizador de inatividade quando ocorrer uma interação do usuário
        window.addEventListener('mousemove', resetTimer);
        window.addEventListener('keydown', resetTimer);
        window.addEventListener('scroll', resetTimer);

        // Função para reiniciar o temporizador de inatividade
        function resetTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(redirectToLogin, inactivityTimeout);
        }
    </script>
</head>
<body style="background-color: #545657;">
    <div class="container">
        <div class="menu">
            <a href="logout.html"><button>Desconectar</button></a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="cadastrar_produto.php" class="btn btn-registro"><img src="registro.png" alt="Cadastrar"><br>Cadastrar</a>
            </div>
            <div class="col-md-4">
                <a href="produtos_vendidos.php" class="btn btn-vendidos"><img src="pedido.png" alt="Produtos Vendidos"><br>Produtos Vendidos</a>
            </div>
            <div class="col-md-4">
                <a href="produtos.php" class="btn btn-estoque"><img src="estoque-pronto.png" alt="Estoque"><br>Estoque</a>
            </div>
        </div>
        <h1>Vender Produtos</h1>
    </div>
    <div class="container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="produto">Selecione o produto:</label>
                <select class="form-control" name="produto" id="produto">
                    <?php
                    // Gerar as opções do select
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $nome = $row['produto'];
                            echo "<option value=\"$id\">$nome</option>";
                        }
                    } else {
                        echo "<option value=\"\">Nenhum Produto Disponível</option>";
                    }
                    ?>
                </select>
            </div>

            <?php
            // Verificar se o formulário foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obter os dados do formulário
                $produtoId = $_POST['produto'];
                $quantidade = $_POST['quantidade'];

                // Selecionar o produto do banco de dados
                $query = "SELECT * FROM deposito WHERE id = '$produtoId'";
                $resultado = $mysqli->query($query);

                if ($resultado && $resultado->num_rows > 0) {
                    $produto = $resultado->fetch_assoc();

                    // Verificar se há estoque suficiente
                    if ($produto['quantidade'] >= $quantidade) {
                        // Calcular novo estoque
                        $novoEstoque = $produto['quantidade'] - $quantidade;

                        // Atualizar o estoque do produto vendido
                        $atualizarQuery = "UPDATE deposito SET quantidade = '$novoEstoque' WHERE id = '$produtoId'";
                        if ($mysqli->query($atualizarQuery)) {
                            // Verificar se o produto já existe na tabela de produtos vendidos
                            $verificarQuery = "SELECT * FROM vendidos WHERE produto = '" . $produto['produto'] . "'";
                            $verificarResultado = $mysqli->query($verificarQuery);

                            if ($verificarResultado && $verificarResultado->num_rows > 0) {
                                $produtoVendido = $verificarResultado->fetch_assoc();
                                $quantidadeAtualizada = $produtoVendido['quantidade'] + $quantidade;
                                $valorAtualizado = $produtoVendido['valor'] + (floatval($quantidade) * floatval($produto['valor']));

                                // Atualizar a quantidade e o valor do produto existente na tabela de produtos vendidos
                                $atualizarProdutoQuery = "UPDATE vendidos SET quantidade = '$quantidadeAtualizada', valor = '$valorAtualizado' WHERE produto = '" . $produto['produto'] . "'";
                                $mysqli->query($atualizarProdutoQuery);
                            } else {
                                // Inserir um novo produto vendido na tabela de produtos vendidos
                                $inserirQuery = "INSERT INTO vendidos (produto, quantidade, valor) 
                                VALUES ('" . $produto['produto'] . "', '" . $quantidade . "', '" . ($quantidade * $produto['valor']) . "')";
                                $mysqli->query($inserirQuery);
                            }

                            echo "<h2 class=\"text-success\">Produto vendido com sucesso!</h2>";
                        } else {
                            echo "<h2 class=\"text-danger\">Erro ao atualizar o estoque: </h2>" . $mysqli->error;
                        }
                    } else {
                        echo "<h2 class=\"text-danger\">Estoque insuficiente!</h2>";
                    }
                } else {
                    echo "<h2 class=\"text-danger\">Produto não encontrado!</h2>";
                }
            }

            $mysqli->close();
            ?>

            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input class="form-control" type="number" name="quantidade" id="quantidade">
            </div>

            <input class="btn btn-primary" type="submit" value="Vender">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
