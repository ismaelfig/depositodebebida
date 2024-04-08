<?php
if(isset($_POST['confirmar'])) {

    include("conexao.php");
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM deposito WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query) { ?>
        <body style="background-color: gray;">
        <h1 style="color: red; font-size:50px;">Produto deletado com sucesso!</h1>
        <h2 style="color:red;font-size:30px;"><a href="produtos.php">Clique aqui</a> para voltar para a lista de produtos.</h2>
        </body>
        <?php
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deletar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="deletar_produto.css">
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
    <h1>Deseja deletar este produto?</h1>
    <form action="" method="post">
        <a  href="produtos.php" class= "btn btn-voltar">Não</a>
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>