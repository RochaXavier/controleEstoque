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
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php include "nav.php" ?>
        <h1>Lista de pedidos</h1>

        <div class="container">
            <button id="novoPedido" class="btn btn-sm btn-primary btn-cadastro " data-toggle="modal"  data-target="#modalCadastro">Cadastrar novo Pedido</button>
            <table class="table table-responsive table-pedidos">
                <thead>
                    <tr>
                        <th class="col-md-4">Produto</th>
                        <th class="col-md-4">Cliente</th>                        
                        <th class="col-md-2">Editar</th> 
                        <th class="col-md-2">Excluir</th> 
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
                                <button class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#modalEdicao">Editar</button>
                            </td> 
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal"  data-target="#modalExclucao">Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>				
                </tbody>
            </table>
        </div>




        <div class="modal fade" id="modalCadastro">
            <div class="modal-content modal-dialog modal-sm">

                <form class="form"  method="POST">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastrar produto</h4>
                    </div>
                    <div class="modal-body">
                        <select  name="id_cliente" class="form-control">
                            <?php foreach ($clientes as $cliente) {
                                ?>
                                <option value= <?= $cliente["id"] ?>> 
                                    <?= $cliente["nome"] ?>                        
                                </option>
                                <?php }
                            ?>

                        </select >
                        <label>Produto: </label>
                        <select  class="form-control" name="id_produto">
                            <?php foreach ($produtos as $produto) {
                                ?>
                                <option value= <?= $produto["id"] ?>>
                                    <?= $produto["nome"] ?>
                                </option>
                                <?php }
                            ?>

                        </select>
                    </div>              

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="cadastrarPedido">Cadastrar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
                    </div>
                </form>  
            </div>
        </div>






        <div class="modal fade" id="modalEdicao">
            <div class="modal-content modal-dialog modal-sm">

                <form class="form">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar produto</h4>
                    </div>
                    <div class="modal-body">
                        <select  name="id_cliente" class="form-control">
                            <?php foreach ($clientes as $cliente) {
                                ?>
                                <option value= <?= $cliente["id"] ?>> 
                                    <?= $cliente["nome"] ?>                        
                                </option>
                                <?php }
                            ?>

                        </select>
                        <label>Produto: </label>
                        <select  name="id_produto" class="form-control">
                            <?php foreach ($produtos as $produto) {
                                ?>
                                <option value= <?= $produto["id"] ?>>
                                    <?= $produto["nome"] ?>
                                </option>
                                <?php }
                            ?>

                        </select>
                    </div>              

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="editarPedido">Editar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
                    </div>
                </form>  
            </div>
        </div>


        <div class="modal fade" id="modalExclucao">
            <div class="modal-content modal-dialog modal-sm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Excluir pedido</h4>
                </div>
                <div class="modal-body">
                    <p>Realmente gostaria de excluir esse pedido?</p>
                    <button class="confirm-delete btn btn-danger" data-dismiss="modal">Sim</button>
                    <button class="btn btn-info" data-dismiss="modal">Nao</button>   
                </div>               
            </div>
        </div>


    </body>
</html>
