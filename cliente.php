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
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>


        <h1>Lista de clientes</h1>
        <!--tabela de produtos cadatrados-->
        <div class="container">
            <button id="novoCliente" class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalCadastro">Cadastrar Cliente</button>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>email</th>
                        <th>telefone</th>
                        <th>Editar</th>
                        <th>Excluir</th>
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
                                <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalEdicao" onclick="prepararEdicao(
                                        <?php echo $cliente['id']; ?>)">Editar</button>
                            </td> 
                            <td>
                                <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalExclucao"  onclick="prepararExclusao(
                                        <?php echo $cliente['id']; ?>)">Excluir</button>
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
