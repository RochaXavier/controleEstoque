<?php
include '/core/db.php';
include '/core/crud.php';
$pedidoCrud = new crud("pedido");
$pedidos = $pedidoCrud->select("produto.nome AS produto, cliente.nome AS cliente", "produto.id = pedido.id_produto AND cliente.id = pedido.id_cliente", "produto, cliente, pedido");
$produtoCrud = new crud("produto");
$produtos = $produtoCrud->select("*");
$clienteCrud = new crud("cliente");
$clientes = $clienteCrud->select("*");

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>    

</head>

<body>
    <?php include "nav.php" ?>

    <div class="container">
        <button id="novoPedido" class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalCadastro">Cadastrar novo Pedido</button>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Cliente</th>                        
                    <th>Editar</th> 
                    <th>Excluir</th> 
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($pedidos as $pedido) {
                    ?>
                    <tr>                            
                        <td><?= $pedido['produto']; ?></td>
                        <td><?= $pedido['cliente']; ?></td>                            
                        <td>
                            <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalEdicao">Editar</button>
                        </td> 
                        <td>
                            <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalExclucao">Excluir</button>
                        </td>
                    </tr>
                    <?php } ?>				
                </tbody>
            </table>
        </div>


        <div class="modal fade" id="modalCadastro"  style="display: none">
            <form method="POST">
                <label>Cliente:</label>
                <select  name="id_cliente">
                    <?php foreach ($clientes as $cliente) {
                        ?>
                        <option value= <?= $cliente["id"]?>> 
                            <?= $cliente["nome"]?>                        
                        </option>
                        <?php
                    } ?>

                </select>
                <label>Produto: </label>
                <select  name="id_produto">
                    <?php foreach ($produtos as $produto) {
                        ?>
                        <option value= <?= $produto["id"]?>>
                         <?= $produto["nome"]?>
                     </option>
                     <?php
                 } ?>

             </select>
             <input type="submit" name="cadastrarPedido">
         </form>
     </div>

     <div class="modal fade" id="modalEdicao"  style="display: none">
        <form method="POST">
            <label>Cliente:</label>
            <select  name="id_cliente">
                <?php foreach ($clientes as $cliente) {
                    ?>
                    <option value= <?= $cliente["id"]?>> 
                        <?= $cliente["nome"]?>                        
                    </option>
                    <?php
                } ?>

            </select>
            <label>Produto: </label>
            <select  name="id_produto">
                <?php foreach ($produtos as $produto) {
                    ?>
                    <option value= <?= $produto["id"]?>>
                     <?= $produto["nome"]?>
                 </option>
                 <?php
             } ?>

         </select>
         <input type="submit" name="editarPedido">
     </form>
 </div>

 <div class="modal fade" id="modalExclucao" style="display: none">
    <h4>excluir Cliente</h4>
    <p>Realmente gostaria de excluir esse pedido?</p>
    <button >Sim</button>
    <button>Nao</button>
</div>


</body>
</html>
