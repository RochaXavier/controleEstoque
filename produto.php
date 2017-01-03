<?php
include '/core/db.php';
include '/core/crud.php';
$produtoCrud = new crud("produto");
$produtos = $produtoCrud->select("*");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
    <link href="css/style.css" rel="stylesheet" type="text/css"/>

</head>
<body>	

    <?php include "nav.php" ?>

    <?php
    if (isset($_POST['nomeInsercao']) && isset($_POST['descricaoInsercao']) && isset($_POST['precoInsercao'])) {
        $valores = [];
        array_push($valores, $_POST['nomeInsercao']);
        array_push($valores, $_POST['descricaoInsercao']);
        array_push($valores, $_POST['precoInsercao']);

        if ($produtoCrud->insert('nome, descricao, preco', $valores)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=produto.php'>";
        }
    }
    ?>
    <h1>Lista de produtos</h1>
    <!--tabela de produtos cadatrados-->
    <div class="container">
        <button id="novoProduto" class="btn btn-sm btn-primary btn-cadastro" data-toggle="modal"  data-target="#modalCadastro">Cadastrar Produto</button>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th class="col-md-1">Id</th>
                    <th class="col-md-3">Nome</th>                    
                    <th class="col-md-3">Descrição</th>
                    <th class="col-md-3">Preço</th>
                    <th class="col-md-1">Editar</th>
                    <th class="col-md-1">Excluir</th>
                </tr>
            </thead>
            <!--tr com dados do banco-->
            <tbody>
                <?php
                foreach ($produtos as $produto) {
                    ?>
                    <tr>
                        <td><?= $produto['id']; ?></td>
                        <td><?= $produto['nome']; ?></td>                        
                        <td><?= $produto['descricao']; ?></td>
                        <td>R$<?= number_format($produto['preco'], 2, ',', ''); ?>  </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#modalEdicao">Editar</button>
                        </td> 
                        <td>
                            <button class="btn btn-sm btn-warning" data-toggle="modal"  data-target="#modalExclucao">Excluir</button>
                        </td>
                    </tr>
                    <?php }
                    ?>				
                </tbody>
            </table>
        </div>



        <!--formulario de cadastro do produto-->
        <div class="modal fade" id="modalCadastro" style="display: none">
            <form method="POST">
                <label>Nome:</label>
                <input type="text" name="nomeInsercao">
                <label>Descrição:</label>
                <input type="text" name="descricaoInsercao">
                <label>Preço: </label>
                <input type="number" name="precoInsercao" step="0.1">                            
                <input type="submit" name="cadastrarProduto">
            </form>
        </div>



        <div class="modal fade" id="modalEdicao">
            <div class="modal-content modal-dialog modal-sm">

                <form class="form">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar produto</h4>
                    </div>
                    <div class="modal-body">
                        <label>Nome:</label>
                        <input type="text" name="nomeEdicao" class="form-control">
                        <label>Descrição:</label>
                        <input type="text" name="descricaoEdicao" class="form-control">
                        <label>Preço:</label>
                        <input type="number" name="precoEdicao" step="0.1" class="form-control">
                    </div>              

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="edicaoProduto">Editar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
                    </div>
                </form>  
            </div>
        </div>


        <div class="modal fade" id="modalExclucao">
            <div class="modal-content modal-dialog modal-sm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Realmente gostaria de excluir esse item?</p>
                    <button class="confirm-delete" data-dismiss="modal">Sim</button>
                    <button data-dismiss="modal">Nao</button>   
                </div>               
            </div>
        </div>



        <script type="text/javascript">
            var options;
            $(document).ready(function () {
                $('.delete-produto').click(function () {
                    console.log(this.id);
                    options = {
                        type: "post",
                        data: {idProd: $(this).attr('id')},
                        url: "produto.php"
                    }
                });
            });

            $(document).ready(function () {
                $('.confirm-delete').click(function () {
                    $.ajax(options);
                })
            });

        </script>

        <?php
        if (isset($_POST['idProd'])) {
            if ($produtoCrud->delete("id = " . $_POST['idProd'])) {
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=produto.php'>";
            }
        }
        ?>

    </body>
    </html>
