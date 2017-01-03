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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>    
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



        <!--formulario de cadastro do produto-->
        <div class="modal fade" id="modalCadastro" style="display: none">
            <h4>Cadastrar novo Cliente</h4>
            <form>
                <label>Nome: </label>
                <input type="text" id="nomeCadastro">
                <label>Email: </label>
                <input type="email" id="emailCadastro">
                <label>Telefone: </label>
                <input type="text" id="telefoneCadastro">
                <input type="submit" id="cadastrarCliente">
            </form>
        </div>

        <!--formulario de edição de produto-->
        <div class="modal fade" id="modalEdicao" style="display: none">
            <h4>Editar Cliente</h4>
            <form>
                <label>Nome: </label>
                <input type="text" id="nomeEdicao">
                <label>Email: </label>
                <input type="email" id="emailEdicao">
                <label>Telefone: </label>
                <input type="text" id="telefoneEdicao">
                <input type="submit" id="editarCliente">
            </form>		
        </div>

        <div class="modal fade" id="modalExclucao" style="display: none">
            <h4>excluir Cliente</h4>
            <p>Realmente gostaria de excluir esse cliente?</p>
            <button >Sim</button>
            <button>Nao</button>
        </div>

        <script src="js/cliente.js" type="text/javascript"></script>

    </body>
    </html>
