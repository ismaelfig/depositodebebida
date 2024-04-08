<?php
// Conectar-se ao banco de dados
include('conexao.php');

// Selecionar os produtos vendidos do banco de dados
$query = "SELECT * FROM vendidos";
$resultado = mysqli_query($mysqli, $query);
$query_produtos = $mysqli->query($query) or die($mysqli->error);
$num_produtos = $query_produtos->num_rows;

if ($resultado && mysqli_num_rows($resultado) > 0) {
   while ($produto = mysqli_fetch_assoc($resultado)) {
   }
} else {
   echo "Nenhum produto vendido encontrado.";
}

mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista de Produtos Vendidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="produtos_vendidos.css">
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
                <a href="produtos.php" class="btn btn-estoque"><img src="estoque-pronto.png" alt="Estoque"><br> Estoque</a>
            </div>
        </div>

        <h1>Lista de Produtos Vendidos</h1>
        <p>Estes são os produtos vendidos</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num_produtos == 0) { ?>
                  <tr>
                    <td colspan="5">Nenhum produto foi vendido!</td>
                  </tr> 
                <?php 
                } else {
                    while ($produto = $query_produtos->fetch_assoc()) {
                        $data_venda = date("d/m/Y H:i", strtotime($produto['data']));
                        
                       
                ?>
                <tr>
                    <td><?php echo $produto['id']; ?></td>
                    <td><?php echo $produto['produto']; ?></td>
                    <td><?php echo $produto['quantidade']; ?></td>
                    <td><?php echo $produto['valor']; ?></td>
                    <td><?php echo $data_venda; ?></td>
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

