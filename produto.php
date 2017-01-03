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

        <?php
        if (isset($_POST['nomeInsercao']) && isset($_POST['descricaoInsercao']) && isset($_POST['precoInsercao'])) {
            if ($_POST['nomeInsercao'] && $_POST['descricaoInsercao'] && $_POST['precoInsercao']) {
                $valores = [];
                array_push($valores, $_POST['nomeInsercao']);
                array_push($valores, $_POST['descricaoInsercao']);
                array_push($valores, $_POST['precoInsercao']);
                if ($produtoCrud->insert('nome, descricao, preco', $valores)) {
                    echo "<script>alert('Inserido com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao inserir os dados!');</script>";
                }
            } else {
                echo "<script>alert('Informe todos os dados!!');</script>";
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

            <form class="form"  method="POST">

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
        });
    </script>
</body>
</html>
