<?php

include('conexao.php');
$id= intval($_GET['id']);

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}

if(count($_POST) > 0) {
     
    $erro = false;
    $produto = $_POST['produto'];
    $estoque = $_POST['estoque'];
    $valor = $_POST['valor'];

    if(empty($produto)) {
    $erro = "Preencha o produto";
    }
    if(empty($estoque)) {
        $erro = "Preencha o estoque";
    }
    if(empty($valor)) {
        $erro = "Preencha o valor";
    }
    if($erro) {
        echo "<p><b>ERRO:$erro</b></p>";
    }   else {
        $sql_code = "UPDATE deposito
        SET produto = '$produto',
        estoque = '$estoque', 
        valor = '$valor'
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>
    <a href="produtos.php">Voltar para a lista de produtos</a>
    <form method="POST" action="">
    <p>
        <label>Produto:</label>
        <input value="<?php echo $produto['produto']; ?>" name="produto" type="text">

    </p>
    <p>
        <label>Estoque:</label>
        <input value="<?php echo $produto ['estoque']; ?>" name="estoque" type="text">
        
    </p> 
    <p>
        <label>Valor:</label>
        <input value="<?php echo $produto['valor']; ?>" name="valor" type="text">
        
    </p>
    <p>
        <button type="submit">Salvar Produto</button>
    </p>
    </form>
</body>
</html>