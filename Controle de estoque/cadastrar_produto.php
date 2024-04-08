<?php

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}

if(count($_POST) > 0) {

    include('conexao.php');
    
    $erro = false;
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];

    if(empty($produto)) {
        $erro = "Preencha o produto";
    }
    if(empty($quantidade)) {
        $erro = "Preencha a quantidade";
    }
    if(empty($valor)) {
        $erro = "Preencha o valor";
    }
    if($erro) {
        
        echo "<p><font color=red><b>ERRO: $erro</b></font></p>";
    } else {
        $sql_code = "INSERT INTO deposito (produto, quantidade, valor, data)
        VALUES ('$produto', '$quantidade', '$valor', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
            echo "<h2><font color=forestgreen><b>Produto cadastrado com sucesso!</b></font></h2>";
            unset($_POST);
        }
    }   
}

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="cadastro.css">
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
                <a href="produtos_vendidos.php" class="btn btn-vendidos"><img src="pedido.png" alt="Produtos Vendidos"><br>Produtos Vendidos</a>
            </div>
            <div class="col-md-4">
                <a href="venda.php" class="btn btn-compras"><img src="carrinho-de-compras.png" alt="Vender Produto"><br>Vender Produto</a>
            </div>
            <div class="col-md-4">
                <a href="produtos.php" class="btn btn-estoque"><img src="estoque-pronto.png" alt="Estoque"><br>Estoque</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h1>Cadastrar Produto</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="produto" class="form-label">Produto:</label>
                <input value="<?php if(isset($_POST['produto'])) echo $_POST['produto']; ?>" name="produto" type="text" class="form-control" id="produto">
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input value="<?php if(isset($_POST['quantidade'])) echo $_POST['quantidade']; ?>" name="quantidade" type="text" class="form-control" id="quantidade">
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor:</label>
                <input value="<?php if(isset($_POST['valor'])) echo $_POST['valor']; ?>" name="valor" type="text" class="form-control" id="valor">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
