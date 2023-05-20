<?php
include('conexao.php');

$sql_produtos = "SELECT * FROM deposito";
$query_produtos = $mysqli->query($sql_produtos) or die($mysqli->error);
$num_produtos = $query_produtos->num_rows;
?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>  
<body>
<a href="cadastrar_produto.php">Cadastrar Produto</a>
<a href="venda_produtos.php">Vender Produto</a>
    <h1>Lista de Produtos</h1>
    <p>Estes são os produtos cadastrados</p>
    <table border="1" cellpadding= "10">
        <thead>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Data</th>
            <th></th>
        </thead>
        <tbody>
            <?php if($num_produtos == 0) { ?>
              <tr>
                <td colspan="7">Nenhum produto foi cadastrado!</td>
              </tr> 
            <?php 
            } else {
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
                        <a href="editar_produto.php?id=<?php echo $produto['id'];?>">Editar</a>
                        <a href="deletar_produto.php?id=<?php echo $produto['id'];?>">Deletar</a>
                    </td>   
                </tr>
                <?php
                }
            } ?>
            
        </tbody>
    </table>
    
</body>
</html>