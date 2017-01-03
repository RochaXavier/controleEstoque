<?php
include '/core/db.php';
include '/core/crud.php';
$pedidoCrud = new crud("pedido");
$pedidos = $pedidoCrud->select("pedido.id, pedido.id_produto, pedido.id_cliente,produto.nome AS produto, cliente.nome AS cliente", "produto.id = pedido.id_produto AND cliente.id = pedido.id_cliente", "produto, cliente, pedido");
$produtoCrud = new crud("produto");
$produtos = $produtoCrud->select("id,nome");
$clienteCrud = new crud("cliente");
$clientes = $clienteCrud->select("id,nome");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pedidos</title>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>    
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <script type="text/javascript">
            var idEdicao;
            function prepararEdicao(id, produto, cliente) {
                idEdicao = id;
                $("#editarPedido").prepend("Você está editando o pedido do cliente " + cliente + " que pediu o " + produto);
            }
        </script>

        <?php include "nav.php";
        ?>
        <h1>Lista de pedidos</h1>

        <div class="container">
            <button id="novoPedido" class="btn btn-sm btn-primary btn-cadastro " data-toggle="modal"  data-target="#modalCadastro">Cadastrar novo Pedido</button>
            <table class="table table-responsive table-pedidos">
                <thead>
                    <tr>
                        <th class="col-md-2">Id</th>
                        <th class="col-md-3">Produto</th>
                        <th class="col-md-3">Cliente</th>                        
                        <th class="col-md-2">Editar</th> 
                        <th class="col-md-2">Excluir</th> 
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($pedidos as $pedido) {
                        ?>
                        <tr>
                            <td><?= $pedido['id']; ?> </td>
                            <td><?= $pedido['produto']; ?> </td>
                            <td><?= $pedido['cliente']; ?></td>                                
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" onclick="prepararEdicao(<?= $pedido['id']; ?>, '<?= $pedido['produto']; ?>', '<?= $pedido['cliente']; ?>')" data-target="#modalEdicao">Editar</button>
                            </td> 
                            <td>
                                <button class="btn btn-sm btn-warning delete-pedido" id="<?= $pedido['id']; ?>" data-toggle="modal" data-target="#modalExclucao">Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>				
                </tbody>
            </table>
        </div>




        <div class="modal fade" id="modalCadastro">
            <div class="modal-content modal-dialog modal-sm">

                <form class="form"  method="POST" action="cadastroPedido.php">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastrar pedido</h4>
                    </div>
                    <div class="modal-body">
                        <select  name="id_cliente" class="form-control">
                            <option value="">----Selecione----</option>
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
                            <option value="">----Selecione----</option>
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
                        <h4 class="modal-title">Editar pedido</h4>
                    </div>
                    <div class="modal-body">
                        <p id="editarPedido"></p>
                        <label>Cliente: </label>
                        <select  name="id_cliente" class="form-control">
                            <option value="">----Selecione----</option>
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
                            <option value="">----Selecione----</option>
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
                        <button type="submit" class="btn btn-success" id="editarPedido">Editar</button>
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

        <script type="text/javascript">
            $(document).ready(function () {
                var id;
                $('#editarPedido').click(function () {
                       console.log("editar dados");
                });
                $('.delete-pedido').click(function () {
                    id = $(this).attr('id');
                    console.log(id);
                });
                $('.confirm-delete').click(function () {
                    console.log("da certo merda");
                    $.ajax({
                        type: "post",
                        data: {
                            id: id
                        },
                        url: "deletePedido.php",
                        success: function () {
                            location.reload();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
