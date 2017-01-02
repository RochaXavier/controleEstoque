<?php
include '/core/db.php';
include '/core/crud.php';
$pedidoCrud = new crud("pedido");
$pedidos = $pedidoCrud->select("*");
$produtoCrud = new crud("produto");
$produtos = $produtoCrud->select("*");
$clienteCrud = new crud("cliente");
$clientes = $clienteCrud->select("*");

?>
<html>
    <head>
        <title>Pedidos</title>
    </head>
    <body>
   <div class="container">
            <button id="novoPedido" class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalCadastro">Cadastrar novo Pedido</button>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Cliente</th>                        
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($pedidos as $pedido) {
                        ?>
                        <tr>                            
                            <td><?= $pedido['id_produto']; ?></td>
                            <td><?= $pedido['id_cliente']; ?></td>                            
                            <td>
                                <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalEdicao" onclick="prepararEdicao(
                                        <?php echo $pedido['']; ?>)">Editar</button>
                            </td> 
                            <td>
                                <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalExclucao"  onclick="prepararExclusao(
                                        <?php echo $pedido['']; ?>)">Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>				
                </tbody>
            </table>
        </div>

    </body>
</html>
