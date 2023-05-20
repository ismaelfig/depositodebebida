<?php
if(isset($_POST['confirmar'])) {

    include("conexao.php");
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM deposito WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query) { ?>
        <h1>Produto deletado com sucesso!</h1>
        <p><a href="produtos.php">Clique aqui</a> para voltar para a lista de produtos.</p>
        <?php
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Produto</title>
</head>
<body>
    <h1>Tem certeza que deseja deletar este produto?</h1>
    
    <form action="" method="post">
        <a style="margin-right:40px;" href="produtos.php">Não</a>
        <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
</body>
</html>