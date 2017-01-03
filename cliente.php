<!DOCTYPE html>
<?php
include '/core/db.php';
include '/core/crud.php';
$clienteCrud = new crud("cliente");
$clientes = $clienteCrud->select("*");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clientes</title>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>    
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <?php include "nav.php" ?>


        <h1>Lista de clientes</h1>
        <!--tabela de produtos cadatrados-->
        <div class="container">
            <button id="novoCliente" class="btn btn-sm btn-primary btn-cadastro" data-toggle="modal"  data-target="#modalCadastro">Cadastrar Cliente</button>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="col-md-1">Id</th>
                        <th class="col-md-3">Nome</th>
                        <th class="col-md-3">email</th>
                        <th class="col-md-3">telefone</th>
                        <th class="col-md-1">Editar</th>
                        <th class="col-md-1">Excluir</th>
                    </tr>
                </thead>
                <!--tr com dados do banco-->
                <tbody>
                    <?php
                    foreach ($clientes as $cliente) {
                        ?>
                        <tr>
                            <td><?= $cliente['id']; ?></td>
                            <td><?= $cliente['nome']; ?></td>
                            <td><?= $cliente['email']; ?></td>
                            <td><?= $cliente['telefone']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#modalEdicao" >Editar</button>
                            </td> 
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal"  data-target="#modalExclucao"  >Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>				
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modalCadastro">
            <div class="modal-content modal-dialog modal-sm">

                <form class="form" method="POST" action="cadastroCliente.php">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastrar cliente</h4>
                    </div>
                    <div class="modal-body">
                        <label>Nome: </label>
                        <input type="text" name="nomeCadastro" class="form-control">
                        <label>Email: </label>
                        <input type="email" name="emailCadastro" class="form-control">
                        <label>Telefone: </label>
                        <input type="text" name="telefoneCadastro" class="form-control">
                    </div>              

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="cadastrarCliente">Cadastrar</button>
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
                        <label>Nome: </label>
                        <input type="text" id="nomeEdicao" class="form-control">
                        <label>Email: </label>
                        <input type="email" id="emailEdicao" class="form-control">
                        <label>Telefone: </label>
                        <input type="text" id="telefoneEdicao" class="form-control">
                    </div>              

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="editarCliente">Editar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
                    </div>
                </form>  
            </div>
        </div>

        <div class="modal fade" id="modalExclucao">
            <div class="modal-content modal-dialog modal-sm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Excluir cliente</h4>
                </div>
                <div class="modal-body">
                    <p>Realmente gostaria de excluir esse cliente?</p>
                    <button class="confirm-delete btn btn-danger" data-dismiss="modal">Sim</button>
                    <button class="btn btn-info" data-dismiss="modal">Nao</button>   
                </div>               
            </div>
        </div>
    </body>
</html>
