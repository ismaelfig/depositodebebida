<?php
include('conexao.php');

$sql_produtos = "SELECT * FROM deposito";
$query_produtos = $mysqli->query($sql_produtos) or die($mysqli->error);
$num_produtos = $query_produtos->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="produtos.css">
    <title>Lista de Produtos</title>
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
<body>
    <div class="container">
        <div class="menu">
            <a href="logout.html"><button>Desconectar</button></a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="cadastrar_produto.php" class="btn btn-registro"><img src="registro.png" alt="Cadastrar Produto"><br> Cadastrar Produto</a>
            </div>
            <div class="col-md-4">
                <a href="venda.php" class="btn btn-compras"><img src="carrinho-de-compras.png" alt="Vender Produto"><br> Vender Produto</a>
            </div>
            <div class="col-md-4">
                <a href="produtos_vendidos.php" class="btn btn-vendidos"><img src="pedido.png" alt="Produtos Vendidos"><br>Produtos Vendidos</a>
            </div>
        </div>
        <h1 class="mt-4">Produtos Cadastrados</h1>
        <p>Estes são os produtos cadastrados:</p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Editar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($num_produtos == 0) { ?>
                    <tr>
                        <td colspan="6">Nenhum produto foi cadastrado!</td>
                    </tr>
                <?php } else {
                    while ($produto = $query_produtos->fetch_assoc()) {
                        $data_produto = date("d/m/Y H:i", strtotime($produto['data']));
                ?>
                        <tr>
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo $produto['produto']; ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                            <td><?php echo $produto['valor']; ?></td>
                            <td><?php echo $data_produto; ?></td>
                            <td>
                                <a href="editar_produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                <a href="deletar_produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-danger">Deletar</a>
                            </td>
                        </tr>
                <?php
                    }
                } ?>
            </tbody>
        </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
