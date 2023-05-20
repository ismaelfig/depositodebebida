<?php

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}

if(count($_POST) > 0) {

    include('conexao.php');
    
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
        echo "<p><font color=red><b>ERRO:$erro</b></font></p>";
    }   else {
        $sql_code = "INSERT INTO deposito (produto, estoque, valor, data)
        VALUES ('$produto', '$estoque', '$valor', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
            echo "<p><font color=forestgreen><b>Produto cadastrado com sucesso!</b></font></p>";
            unset($_POST);
        }
    }   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    
    <div class="container">
        <a href="produtos.php">Produtos Cadastrados</a>

    </div>
    <h1>Cadastrar Produto</h1>
    <form method="POST" action="">
    <p>
        <label>Produto:</label>
        <input value="<?php if(isset($_POST['produto'])) echo $_POST['produto']; ?>" name="produto" type="text">

    </p>
    <p>
        <label>Estoque:</label>
        <input value="<?php if(isset($_POST['estoque'])) echo $_POST['estoque']; ?>" name="estoque" type="text">
        
    </p> 
    <p>
        <label>Valor:</label>
        <input value="<?php if(isset($_POST['valor'])) echo $_POST['valor']; ?>" name="valor" type="text">
        
    </p>
    <p>
        <button type="submit">Cadastrar</button>
    </p>
    </form>
</body>
</html>