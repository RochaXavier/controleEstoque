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
        <script src="js/bootstrap.min.js" type="text/javascript"></script>    
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>	

        <?php include "nav.php" ?>

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
                                <button class="btn btn-sm btn-warning delete-produto" id='<?= $produto['id']; ?>' data-toggle="modal"  data-target="#modalExclucao">Excluir</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>		
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modalCadastro">
            <div class="modal-content modal-dialog modal-sm">

                <form class="form"  method="POST" action="cadastroProduto.php">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastrar produto</h4>
                    </div>
                    <div class="modal-body">
                        <label>Nome:</label>                        
                        <input type="text" name="nomeInsercao" class="form-control">
                        <label>Descrição:</label>
                        <input type="text" name="descricaoInsercao" class="form-control">
                        <label>Preço:</label>
                        <input type="number" name="precoInsercao" step="0.1" class="form-control">
                    </div>              

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="cadastrarProduto">Cadastrar</button>
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
                        <label>Nome:</label>
                        <input id="nEdicao" type="text" name="nomeEdicao" class="form-control">
                        <label>Descrição:</label>
                        <input id="descEdicao" type="text" name="descricaoEdicao" class="form-control">
                        <label>Preço:</label>
                        <input id="precEdicao" type="number" name="precoEdicao" step="0.1" class="form-control">
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
                    <h4 class="modal-title">Excluir produto</h4>
                </div>
                <div class="modal-body">
                    <p>Realmente gostaria de excluir esse item?</p>
                    <button class="confirm-delete btn btn-danger" data-dismiss="modal">Sim</button>
                    <button class="btn btn-info" data-dismiss="modal">Nao</button>   
                </div>               
            </div>
        </div>


        <script type="text/javascript">
            $(document).ready(function () {
                $('.delete-produto').click(function () {
                    var id = $(this).attr('id');
                    console.log(id);
                    $('.confirm-delete').click(function () {
                        var result = confirm("Você realmente quer excluir esse produto?");
                        if (result) {
                            $.ajax({type: "post",
                                data: {idProd: id},
                                url: "deleteProduto.php",
                                success: function () {
                                    location.reload();
                                }});
                        }
                    });
                });

                //edição do produto
                $('.edit-produto').click(function () {
                    id = $(this).attr('id');

                    var lista = '<?php echo json_encode($produtos) ?>';
                    var lista_json = JSON.parse(lista);

                    for (var i = 0; i < lista_json.length; i++) {
                        if (lista_json[i].id === id) {
                            $('#nEdicao').val(lista_json[i].nome);
                            $('#descEdicao').val(lista_json[i].descricao);
                            $('#precEdicao').val(lista_json[i].preco);
                            break;
                        }
                    }
                });

                $('.confirm-edit-produto').click(function () {
                    $.ajax({
                        type: "post",
                        data: {idProd: id,
                            nomeEdic: $('#nEdicao').val(),
                            descEdic: $('#descEdicao').val(),
                            precEdic: $('#precEdicao').val()},
                        url: "alterarProduto.php",
                        success: function () {
                            location.reload();
                        }
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>
