<?php
include('conexao.php');
$id = intval($_GET['id']);

function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

if (count($_POST) > 0) {

    $erro = false;
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];

    if (empty($produto)) {
        $erro = "Preencha o produto";
    }
    if (empty($quantidade)) {
        $erro = "Preencha a quantidade";
    }
    if (empty($valor)) {
        $erro = "Preencha o valor";
    }
    if ($erro) {
        echo "<p><b>ERRO:$erro</b></p>";
    } else {
        $sql_code = "UPDATE deposito
        SET produto = '$produto',
        quantidade = '$quantidade',
        valor = '$valor'
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if ($deu_certo) {
            echo "<p><b>Produto atualizado com sucesso!</b></p>";
            unset($_POST);
        }
    }
}

$sql_produto = "SELECT * FROM deposito WHERE id = '$id'";
$query_produto = $mysqli->query($sql_produto) or die($mysqli->error);
$produto = $query_produto->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="editar_produto.css">
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
        <h1>Editar Produto</h1>
        <div class="voltar">
        <a href="produtos.php">Voltar para a lista de produtos</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label for="produto">Produto:</label>
                <input value="<?php echo $produto['produto']; ?>" name="produto" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input value="<?php echo $produto['quantidade']; ?>" name="quantidade" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input value="<?php echo $produto['valor']; ?>" name="valor" type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar Produto</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
